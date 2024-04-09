<?php
require '../vendor/autoload.php';
use db\connection;

use Slim\App;
use Slim\Extras\Middleware\CsrfGuard;
use Slim\Factory\AppFactory;
use DI\ContainerBuilder;

use Illuminate\Database\Query\Expression as raw;
use model\Annonce;
use model\Categorie;
use model\Annonceur;
use model\Departement;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


connection::createConn();

// Instanciation de SLIM
$builder = new ContainerBuilder();
$builder->addDefinitions([
    'displayErrorDetails' => true,
]);

$c=$builder->build();
$app = AppFactory::createFromContainer($c);
//---

if (!isset($_SESSION)) {
    session_start();
    $_SESSION['formStarted'] = true;
}

if (!isset($_SESSION['token'])) {
    $token = md5(uniqid(rand(), TRUE));
    $_SESSION['token'] = $token;
    $_SESSION['token_time'] = time();
} else {
    $token = $_SESSION['token'];
}

//$app->add(new CsrfGuard());

$loader = new \Twig\Loader\FilesystemLoader('../template');
$twig = new \Twig\Environment($loader);

$menu = array(
    array('href' => "./index.php",
        'text' => 'Accueil')
);

$chemin = dirname($_SERVER['SCRIPT_NAME']);

$cat = new \controller\getCategorie();
$dpt = new \controller\getDepartment();

$app->get('/', function ($request, $response) use ($twig, $menu, $chemin, $cat) {
    $index = new \controller\index();
    $index->displayAllAnnonce($twig, $menu, $chemin, $cat->getCategories());

    return $response->withStatus(200);
});


$app->get('/item/{n}', function ($request, $response) use ($twig, $menu, $chemin, $cat) {
    $n = $request->getAttribute('n');

    $item = new \controller\item();
    $item->afficherItem($twig, $menu, $chemin, $n, $cat->getCategories());

    return $response->withStatus(200);
});

$app->get('/add[/]', function ($request, $response) use ($twig, $app, $menu, $chemin, $cat, $dpt) {

    $ajout = new controller\addItem();
    $ajout->addItemView($twig, $menu, $chemin, $cat->getCategories(), $dpt->getAllDepartments());

    return $response->withStatus(200);
});

$app->post('/add[/]', function ($request, $response) use ($twig, $app, $menu, $chemin) {

    $allPostVars = $request->getParsedBody();
    $ajout = new controller\addItem();
    $ajout->addNewItem($twig, $menu, $chemin, $allPostVars);

    return $response->withStatus(200);
});

$app->get('/item/{id}/edit', function ($request, $response) use ($twig, $menu, $chemin) {
    $id = $request->getAttribute('id');

    $item = new \controller\item();
    $item->modifyGet($twig,$menu,$chemin, $id);

    return $response->withStatus(200);
});

$app->post('/item/{id}/edit', function ($request, $response) use ($twig, $app, $menu, $chemin, $cat, $dpt) {
    $id = $request->getAttribute('id');

    $allPostVars = $request->getParsedBody();
    $item= new \controller\item();
    $item->modifyPost($twig,$menu,$chemin, $id, $cat->getCategories(), $dpt->getAllDepartments());

    return $response->withStatus(200);
});

$app->map(['GET', 'POST'], '/item/{id}/confirm', function ($request, $response) use ($twig, $app, $menu, $chemin) {
    $id = $request->getAttribute('id');

    $allPostVars = $request->getParsedBody();
    $item = new \controller\item();
    $item->edit($twig,$menu,$chemin, $allPostVars, $id);

    return $response->withStatus(200);
})->setName('confirm');

$app->get('/search[/]', function ($request, $response) use ($twig, $menu, $chemin, $cat) {
    $s = new controller\Search();
    $s->show($twig, $menu, $chemin, $cat->getCategories());

    return $response->withStatus(200);
});


$app->post('/search[/]', function ($request, $response) use ($app, $twig, $menu, $chemin, $cat) {
    $array = $request->getParsedBody();

    $s = new controller\Search();
    $s->research($array, $twig, $menu, $chemin, $cat->getCategories());

    return $response->withStatus(200);
});

$app->get('/annonceur/{n}', function ($request, $response) use ($twig, $menu, $chemin, $cat) {
    $n = $request->getAttribute('n');

    $annonceur = new controller\viewAnnonceur();
    $annonceur->afficherAnnonceur($twig, $menu, $chemin, $n, $cat->getCategories());

    return $response->withStatus(200);
});

$app->get('/del/{n}', function ($request, $response) use ($twig, $menu, $chemin) {
    $n = $request->getAttribute('n');

    $item = new controller\item();
    $item->supprimerItemGet($twig, $menu, $chemin, $n);

    return $response->withStatus(200);
});

$app->post('/del/{n}', function ($request, $response) use ($twig, $menu, $chemin, $cat) {
    $n = $request->getAttribute('n');

    $item = new controller\item();
    $item->supprimerItemPost($twig, $menu, $chemin, $n, $cat->getCategories());

    return $response->withStatus(200);
});

$app->get('/cat/{n}', function ($request, $response) use ($twig, $menu, $chemin, $cat) {
    $n = $request->getAttribute('n');

    $categorie = new controller\getCategorie();
    $categorie->displayCategorie($twig, $menu, $chemin, $cat->getCategories(), $n);

    return $response->withStatus(200);
});

$app->get('/api[/]', function ($request, $response) use ($twig, $menu, $chemin, $cat) {
    $template = $twig->loadTemplate("api.html.twig");
    $menu = array(
        array('href' => $chemin,
            'text' => 'Acceuil'),
        array('href' => $chemin . '/api',
            'text' => 'Api')
    );
    echo $template->render(array("breadcrumb" => $menu, "chemin" => $chemin));

    return $response->withStatus(200);
});

$app->get('/api/annonce/{id}', function ($request, $response) use ($app) {
    $id = $request->getAttribute('id');

    $annonceList = ['id_annonce', 'id_categorie as categorie', 'id_annonceur as annonceur', 'id_departement as departement', 'prix', 'date', 'titre', 'description', 'ville'];
    $return = Annonce::select($annonceList)->find($id);

    if (isset($return)) {
        $return->categorie = Categorie::find($return->categorie);
        $return->annonceur = Annonceur::select('email', 'nom_annonceur', 'telephone')
            ->find($return->annonceur);
        $return->departement = Departement::select('id_departement', 'nom_departement')->find($return->departement);
        $links = [];
        $links["self"]["href"] = "/api/annonce/" . $return->id_annonce;
        $return->links = $links;
        
        $response->getBody()->write($return->toJson());
    } else {
        $app->notFound();
    }

    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/api/annonces[/]', function ($request, $response) use ($app) {
    $annonceList = ['id_annonce', 'prix', 'titre', 'ville'];
    
    $a = Annonce::all($annonceList);
    $links = [];
    foreach ($a as $ann) {
        $links["self"]["href"] = "/api/annonce/" . $ann->id_annonce;
        $ann->links = $links;
    }
    $links["self"]["href"] = "/api/annonces/";

    $response->getBody()->write($a->toJson());

    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/api/categorie/{id}', function ($request, $response) use ($app) {
    $id = $request->getAttribute('id');

    $a = Annonce::select('id_annonce', 'prix', 'titre', 'ville')
        ->where("id_categorie", "=", $id)
        ->get();
    $links = [];

    foreach ($a as $ann) {
        $links["self"]["href"] = "/api/annonce/" . $ann->id_annonce;
        $ann->links = $links;
    }

    $c = Categorie::find($id);
    $links["self"]["href"] = "/api/categorie/" . $id;
    $c->links = $links;
    $c->annonces = $a;
    $response->getBody()->write($c->toJson());

    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/api/categories[/]', function ($request, $response) use ($app) {
//     $c = Categorie::all(["id_categorie", "nom_categorie"]);
    $c = Categorie::get();
    $links = [];
    foreach ($c as $cat) {
        $links["self"]["href"] = "/api/categorie/" . $cat->id_categorie;
        $cat->links = $links;
    }
    $links["self"]["href"] = "/api/categories/";
    
    $response->getBody()->write($c->toJson());

    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/api/key', function($request, $response) use ($app, $twig, $menu, $chemin, $cat) {
    $kg = new controller\KeyGenerator();
    $kg->show($twig, $menu, $chemin, $cat->getCategories());

    return $response->withStatus(200);
});

$app->post('/api/key', function($request, $response) use ($app, $twig, $menu, $chemin, $cat) {
    $nom = $_POST['nom'];
    $kg = new controller\KeyGenerator();
    $kg->generateKey($twig, $menu, $chemin, $cat->getCategories(), $nom);

    return $response->withStatus(200);
});

$app->run();

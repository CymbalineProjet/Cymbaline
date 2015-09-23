<?php
$view->extend("header", "Book");
?>


<h1>Le Contrôleur</h1>


    Voici un exemple de contrôleur.
    <pre class="prettyprint linenums lang-php">
        &lt;?php
        namespace source\Demo\DemoBox\controller;

        use core\component\tools\View;
        use core\component\Controller;

        class HelloController extends Controller {

            public function indexAction() {

                $error = false;
                $test = "hello controller index action";

                return new View(array(
                    'error' => $error,
                    'test'  => $test,
                ));
            }

        }
    </pre>

Le contrôleur peut être considéré comme le centre de traitement de vos données. <br />
En effet, le contrôleur est capable de récupérer par exemple les données d'un fomulaire, d'une url et permet l'affichage de vos données.<br />
Ainsi, il peut retourner une vue c'est-à-dire le template que vous aurez choisi pour la page de référence. (Défini dans les routes)

<br /><br />

<h1>URI et Contrôleur</h1>

Les fichiers <em>index.php</em> et <em>app.php</em> récupèrent l'url et initialisent l'application.<br />
Le routeur utilise l'url pour trouver une route et obtient les paramètres du contrôleur, du template et des ressources.

<pre class="prettyprint linenums lang-yaml">
hello_index:
    path: /hello
    template: Demo/DemoBox/template/Hello/index
    controller: Demo/DemoBox/Hello
    action: index
    #ressources: Cymbaline/Book/ressources
</pre>

<b>Les paramètres de route en arguments</b>

<pre class="prettyprint linenums lang-yaml">
hello_edit:
    path: /hello/edit/int@id
    template: Demo/DemoBox/template/Hello/edit
    controller: Demo/DemoBox/Hello
    action: edit
</pre>

<pre class="prettyprint linenums lang-php">
    &lt;?php
    public function editAction(array $args) {
        $id = $args['id'];
    }
</pre>

On récupère les paramètres de l'url et on passe un tableau de paramètres en arguments de la fonction.

<h1>Les objets du contrôleur</h1>

<b>Request :</b>
    <pre class="prettyprint linenums lang-php">
    &lt;?php
    public function indexAction() {
        $request = $this->request;
        $post = $request->get('post');
        $get = $request->get('get');
    }
</pre>

On peut récupérer l'objet requête dans un contrôleur via l'attribut public <em>request</em> comme ci-dessus.

<?php
$view->extend("footer", "");
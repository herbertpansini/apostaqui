<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
| example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
| https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
| $route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
| $route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
| $route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples: my-controller/index -> my_controller/index
|   my-controller/my-method -> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;

/*
| -------------------------------------------------------------------------
| Sample REST API Routes
| -------------------------------------------------------------------------
*/

// Routes for cities
$route['cities']['get'] = 'cities/index';
$route['cities/(:num)']['get'] = 'cities/find/$1';
$route['cities']['post'] = 'cities/index';
$route['cities/(:num)']['put'] = 'cities/index/$1';
$route['cities/(:num)']['delete'] = 'cities/index/$1';

// Routes for forecast
$route['forecast']['get'] = 'forecast/index';
$route['forecast/(:num)']['get'] = 'forecast/find/$1';
$route['forecast']['post'] = 'forecast/index';
$route['forecast/(:num)']['put'] = 'forecast/index/$1';
$route['forecast/(:num)']['delete'] = 'forecast/index/$1';

// Routes for weather
$route['weather']['get'] = 'weather/index';
$route['weather/(:num)']['get'] = 'weather/find/$1';
$route['weather']['post'] = 'weather/index';
$route['weather/(:num)']['put'] = 'weather/index/$1';
$route['weather/(:num)']['delete'] = 'weather/index/$1';

// Routes for Config
$route['configuracao']['get'] = 'configuracao/index';
$route['configuracao/(:num)']['get'] = 'configuracao/find/$1';
$route['configuracao/(:num)']['post'] = 'configuracao/index/$1';
$route['configuracao/(:num)']['delete'] = 'configuracao/index/$1';

// Routes for usuarios
$route['usuario']['get'] = 'usuario/index';
$route['usuario/(:num)']['get'] = 'usuario/find/$1';
$route['usuario']['post'] = 'usuario/index';
$route['usuario/(:num)']['put'] = 'usuario/index/$1';
$route['usuario/(:num)']['delete'] = 'usuario/index/$1';

// Routes for users
$route['user']['get'] = 'user/index';
$route['user/(:num)']['get'] = 'user/find/$1';
$route['user']['post'] = 'user/index';
$route['user/(:num)']['put'] = 'user/index/$1';
$route['user/(:num)']['delete'] = 'user/index/$1';

// Routes for login
$route['login']['post'] = 'login/index';

// Routes for team
$route['equipe']['get'] = 'equipe/index';
$route['equipe/(:num)']['get'] = 'equipe/find/$1';
$route['equipe']['post'] = 'equipe/index';
$route['equipe/(:num)']['put'] = 'equipe/index/$1';
$route['equipe/(:num)']['delete'] = 'equipe/index/$1';

// Routes for rodada
$route['rodada']['get'] = 'rodada/index';
$route['rodada/(:num)']['get'] = 'rodada/find/$1';
$route['rodada']['post'] = 'rodada/index';
$route['rodada/(:num)']['put'] = 'rodada/index/$1';
$route['rodada/(:num)']['delete'] = 'rodada/index/$1';

// Routes for confronto
$route['confronto']['get'] = 'confronto/index';
$route['confronto/(:num)']['get'] = 'confronto/find/$1';
$route['confronto']['post'] = 'confronto/index';
$route['confronto/(:num)']['put'] = 'confronto/index/$1';
$route['confronto/(:num)']['delete'] = 'confronto/index/$1';

// Routes for Aposta
$route['aposta']['get'] = 'aposta/index';
$route['aposta/(:num)']['get'] = 'aposta/find/$1';
$route['aposta']['post'] = 'aposta/index';
$route['aposta/(:num)']['put'] = 'aposta/index/$1';
$route['aposta/(:num)']['delete'] = 'aposta/index/$1';

// Routes for Validate
$route['validate']['get'] = 'validate/index';
$route['validate']['put'] = 'validate/index';

// Routes for Bet
$route['bet']['get'] = 'bet/index';
$route['bet/(:num)']['get'] = 'bet/find/$1';
$route['bet']['post'] = 'bet/index';
$route['bet/(:num)']['put'] = 'bet/index/$1';
$route['bet/(:num)']['delete'] = 'aposta/index/$1';

// Routes for Bet details
$route['betdetail']['get'] = 'betdetail/index';
$route['betdetail/(:num)']['get'] = 'betdetail/find/$1';
$route['betdetail']['post'] = 'betdetail/index';
$route['betdetail/(:num)']['put'] = 'betdetail/index/$1';
$route['betdetail/(:num)']['delete'] = 'betdetail/index/$1';

// Routes for Usuário Apostas
$route['usuarioaposta/(:num)']['get'] = 'usuarioaposta/find/$1';

// Routes for Item Aposta
$route['itemaposta']['get'] = 'itemaposta/index';
$route['itemaposta/(:num)']['get'] = 'itemaposta/find/$1';
$route['itemaposta']['post'] = 'itemaposta/index';
$route['itemaposta/(:num)']['put'] = 'itemaposta/index/$1';
$route['itemaposta/(:num)']['delete'] = 'itemaposta/index/$1';

// Routes for Jogo
$route['jogo']['get'] = 'jogo/index';
$route['jogo/(:num)']['get'] = 'jogo/find/$1';
$route['jogo']['post'] = 'jogo/index';
$route['jogo/(:num)']['put'] = 'jogo/index/$1';
$route['jogo/(:num)']['delete'] = 'jogo/index/$1';

// Routes for sport
$route['esporte']['get'] = 'esporte/index';
$route['esporte/(:num)']['get'] = 'esporte/find/$1';
$route['esporte']['post'] = 'esporte/index';
$route['esporte/(:num)']['put'] = 'esporte/index/$1';
$route['esporte/(:num)']['delete'] = 'esporte/index/$1';

// Routes for Campeonato
$route['campeonato']['get'] = 'campeonato/index';
$route['campeonato/(:num)']['get'] = 'campeonato/find/$1';
$route['campeonato']['post'] = 'campeonato/index';
$route['campeonato/(:num)']['put'] = 'campeonato/index/$1';
$route['campeonato/(:num)']['delete'] = 'campeonato/index/$1';

// Routes for Classificação
$route['classificacao']['get'] = 'classificacao/index';
$route['classificacao/(:num)']['get'] = 'classificacao/find/$1';

// Routes for Tabela
$route['tabela/(:num)']['get'] = 'tabela/index/$1';
$route['tabela/(:num)/(:num)']['get'] = 'tabela/find/$1/$2';

// Routes for Ganhadores
$route['ganhadores/(:num)']['get'] = 'ganhadores/find/$1';

// Routes for Pendente
$route['pendente']['get'] = 'pendente/index';
$route['pendente/(:num)']['get'] = 'pendente/find/$1';

// Routes for Pendencia
$route['pendencia/(:num)']['get'] = 'pendencia/find/$1';

// Routes for Jogos
$route['jogos/(:num)']['get'] = 'jogos/index/$1';
$route['jogos/(:num)/(:num)']['get'] = 'jogos/find/$1/$2';

// Routes for Sequence
$route['sequence']['get'] = 'sequence/index';

// Routes for Profile
$route['perfil']['get'] = 'perfil/index';
$route['perfil/(:num)']['get'] = 'perfil/find/$1';

// Routes for Report
$route['relatorio']['get'] = 'relatorio/index';
$route['relatorio/(:num)']['get'] = 'relatorio/find/$1';

/*
| -------------------------------------------------------------------------
| Sample REST API Routes
| -------------------------------------------------------------------------
*/
//$route['api/example/users/(:num)'] = 'api/example/users/id/$1'; // Example 4
//$route['api/example/users/(:num)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'api/example/users/id/$1/format/$3$4'; // Example 8
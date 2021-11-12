<?php
 
namespace App\Http\Middleware;

 
use Closure;
use Illuminate\Support\Facades\Auth;
use Response;
use Route;
use Request;
 
class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $route = Route::getCurrentRoute();
        $rota = explode("/{", $route->uri)[0];
        $rota = explode("/", $rota);

        if($route->getPrefix()){
            $rota = count($rota) > 2 ? "$rota[0]/$rota[1]" : implode("/", $rota);
        }
        else{
            $rota = $rota[0];
        }


        $rotas = [
            1 => [
                "cliente"
            ],
            2 => [
                "cliente", 
                "arquivo/ativacao",
                "arquivo/cliente",
                "relatorio/ativacao"
            ],
            3 => [
                "cliente", 
                "arquivo/cliente",
                "arquivo/ativacao",
                "arquivo/delivery",
                "relatorio/ativacao",
                "relatorio/delivery",
                // "usuario",
                "ativacao",
                "dashboard",
                "/",
                "/home",
            ],
            4 => [
                "cliente", 
                "arquivo/ativacao",
                "arquivo/delivery",
                "arquivo/cliente",
                // "relatorio",
                "relatorio/ativacao",
                "relatorio/delivery",
                "usuario",
                "ativacao",
                "dashboard",
                "/",
                "/home",
            ]
        ];

        $rotasGrupo = $rotas[auth()->user()->idGrupo];
        
        if($rota == "" || in_array($rota, $rotasGrupo)){
            return $next($request);   
        }
       
        return Response::view('errors.403');


    }
}
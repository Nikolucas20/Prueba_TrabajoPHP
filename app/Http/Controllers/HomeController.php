<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\Notificacion;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function conexion(){
       
        $servidor="localhost";
        $usuario="root";
        $clave="";
        $baseDeDatos="loginpruebas";
    
        $enlace = mysqli_connect($servidor,$usuario,$clave,$baseDeDatos);
        if(!$enlace){
            echo"Error al conectar";
        }
    
        if(isset($_POST['registrar'])){
            $titulo=$_POST["titulo"];
            $descripcion=$_POST["descripcion"];
            $fecha=$_POST["fecha"];
            $completado='0';
            $id_usuario=$_POST["id_usuario"];
            $id_tarea=$_POST["id_tarea"];

            $email=$_POST["email_usuario"];
            $nombre=$_POST["nombre_usuario"];

    
            $insertar = "INSERT into tareas(titulo,descripcion,fecha_vencimiento,completado) VALUES('$titulo','$descripcion','$fecha','$completado')";
            $ejecutar = mysqli_query($enlace, $insertar);

    
            if(!$ejecutar){
                echo "Error al insertar";
            }
            else{

                //Aca se intento hacer la notificacion al correo pero existen problemas por hosting
                //$response = Mail::to($email)->send(new Notificacion($nombre));
                //dump($response);
            }
        }
        return view('home');
    }
}
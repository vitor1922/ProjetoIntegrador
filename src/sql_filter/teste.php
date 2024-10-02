if (isset $_GET['filtro']) {
  $filtro=$_GET['filtro'];
   if ($filtro=="mais-novo")	{
   $sql="query para ordenar pelo mais novo";
   }
   elseif ($filtro=="mais-antigo") {
   $sql="query para ordenar pelo mais antigo";
   }
   elseif ($filtro=="por-turma") {
   $sql="query para ordenar pela turma";
   }
   elseif ($filtro=="por-servico") {
   $sql="query para ordenar pelo serviço";
   }
   else {
   }
}
<!DOCTYPE html>

<?php include 'db.php';

$page = (isset($_GET['page']) ? (int)$_GET['page'] : 1);
$perPage = (isset($_GET['per-page']) && (int)$_GET['per-page'] <= 50 ? (int)$_GET['per-page'] : 5);

$start = ($page > 1) ? ($page * $perPage) - $perPage : 0;

$sql = "select * from task limit ".$start.", ".$perPage." ";
$total = $db->query("select * from task")->num_rows;
$pages = ceil($total / $perPage);


$rows = $db-> query($sql);

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <title>Inicio -Tareas por hacer</title>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-md-offset-2 mb-5 mt-5 ">
                <h2 class="text-center mb-5">TAREAS POR HACER ⛏️ </h2>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal"><i class="bi bi-shield-fill-plus"></i> Agregar tarea</button>
                <button onclick="print()" type="button" class="btn btn-secondary float-right"><i class="bi bi-printer"></i> Imprimir</button>
            </div>
            <!--Search bar-->
            <div class="col-md-10 text-center">
                <h4 >BUSCADOR 🔎 </h4> 
                  <form action="search.php" method="post" class="form-group">
                    <input type="text" placeholder="Ingresa la palabra que buscas y presiona enter" name="search" class="form-control">
                  </form>                
            </div>
            <!-- TASK TABLE -->
            <div class="col-md-10 col-md-offset-1">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Tarea</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <?php while ($row = $rows ->fetch_assoc()): ?>
                            <th scope="row"><?php echo $row['id'] ?></th>
                            <td class="col-md-10"><?php echo $row['name'] ?></td>
                            <td><a href="update.php?id=<?php echo $row['id'];?>" class="btn btn-success">Editar</a></td>
                            <td><a href="delete.php?id=<?php echo $row['id'];?>" class="btn btn-danger">Eliminar</a></td>
                        </tr>
                            <?php endwhile; ?>
                    </tbody>
                </table>
                <!--PAGINATION-->
                    <nav aria-label="Page navigation example ">
                        <ul class="pagination justify-content-center">
                          <?php for ($i = 1; $i <= $pages; $i++): ?>
                                 <li class="page-item"><a class="page-link" href="?page=<?php echo $i;?>"><?php echo $i; ?></a></li>
                          <?php endfor; ?>                      
                        </ul>                    
                    </nav>                              
            </div>
        </div>
    </div>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModal">Nueva tarea</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
         <form method="post" action="add.php">
            <div class="form-group">
                <label for="">Nombre Tarea</label>
                <input type="text" required name="task" class="form-control">         
            </div>
            <input type="submit" name="send" value="Agregar tarea" class="btn btn-success">            
         </form>
         
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</html>
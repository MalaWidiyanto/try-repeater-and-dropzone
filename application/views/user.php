<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href='https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css' type='text/css' rel='stylesheet'>

    <title>PHP CODE TEST</title>
  </head>
  <body>
    <h1>PHP CODE TEST</h1>
    <div class="col-12">
        <table id="example" class="display" style="width:100%">
            <thead>
            <tr>
                <td>No</td>
                <td>Full Name</td>
                <td>BoD</td>
                <td>Address</td>
                <td>Experiences</td>
                <td>Portfolios</td>
            </tr>
            </thead>
            <tbody>
            <?php for($i=0; $i<count($data); $i++){ ?>
            <tr>
                <td><? echo ($i+1) ?></td>
                <td><? echo $data[$i]['first_name'].' '.$data[$i]['last_name'] ?></td>
                <td><? echo $data[$i]['bod'] ?></td>
                <td><? echo $data[$i]['address'] ?></td>
                <td>
                    <?php for($e=0; $e<count($data[$i]['experiences']); $e++){ 
                        echo $data[$i]['experiences'][$e]['company_name'].' - '.$data[$i]['experiences'][$e]['description'].'<br>';
                    } ?>
                </td>
                <td>
                    <?php for($e=0; $e<count($data[$i]['portfolios']); $e++){ ?>
                        <img src="<?php echo $data[$i]['portfolios'][$e]['image_url'] ?>" class="img-fluid" width="100" hieght="100" alt="">;
                    <?php } ?>
                </td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>

</html>

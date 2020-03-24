<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Delzthriftbags | Dashboard</title>
    <!-- Favicon  -->
    <link rel="icon" href="../img/core-img/favicon.png">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <script src="js/jquery-3.4.1.min.js"></script>
</head>
<body>

        <div class="row">
            <nav class="navbar navbar-default">
                <div class="container-fluid" style='text-align:center;'>
                    <a href="../index.php">
                      <!-- Logo -->
                        <img src="../img/core-img/adminlogo.png">
                    </a>
                  <!-- <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Welcome Delz <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a data-toggle="modal" data-target="#bagPost"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Post Bag</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Logout</a></li>
                    </ul>
                    </li>
                </ul> -->
                </div>
              </nav>
        </div>

    <div class="container">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
              </ol>
        </div>
    </div>

    <div class="container">
        <div class="row">


            <div class="col-md-3" style="padding: 0px;">

                <div class="list-group sidePane">
                    <a id="dash" href="#dash" class="list-group-item active"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Dashboard</a>
                    <a href="#post" class="list-group-item"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Post Bag</a class="list-group-item">
                    <a href="#Bags" class="list-group-item"><span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> Bags</a class="list-group-item">
                    <a href="#Clients" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Clients</a class="list-group-item">
                    <a href="#Sales" class="list-group-item"><span class="glyphicon glyphicon-piggy-bank" aria-hidden="true"></span> Sales</a class="list-group-item">
                    <a href="#Cart" class="list-group-item"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Cart</a class="list-group-item">
                </div>

            </div>


            <div class="col-md-9">
                <div id='back' style='cursor:pointer; display:none; padding-bottom:20px; color:pink;'><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Back to menu</div>
                <div id="content"></div>

            </div>

            <!-- Post Bag modal -->
    <div id="bagPost" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <div class="results"></div>
            <form class="modalForm" enctype="multipart/form-data" method="POST">

                <div class="form-group">
                    <label for="desc">Description</label>
                    <textarea type="text" class="form-control" name="desc" id="desc" aria-describedby="emailHelp" placeholder="Description"></textarea>
                </div>
                <div class="form-group">
                    <label for="brand">Brand</label>
                    <input type="text" class="form-control" name="brand" id="brand" placeholder="Brand">
                </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" class="form-control" name="price" id="price" placeholder="Price">
                    </div>
                    <div class="form-group">
                        <label for="quanty">Quantity</label>
                        <input type="text" class="form-control" name="qty" id="qty" placeholder="Quantity">
                    </div>
                <div class="form-group">
                    <label for="cate">Category</label><br/>
                    <select class="catSelect form-group" name="cate" id="cate">
                        <option>Select Category</option>
                        <option>Hand Bags</option>
                        <option>Side Bags</option>
                        <option>Laptop Bags</option>
                        <option>Purses</option>
                        <option>Backpacks</option>
                    </select>
                </div>
                <div class="form-group">

                <div class="upload-btn-wrapper">
                    <label for="images">Images</label><br/>
                    <button class="btn amado-btn active">Upload images</button>
                    <input class="inputfile" type="file" id="upIMG" name="upIMG[]" accept="image/*" multiple/>
                    <!-- <label for="images">Images</label><br/>
                    <input class="inputfile" type="file" id="upIMG" name="upIMG[]" accept="image/*" multiple/><br/> -->
                    <small style="color:pink;">You can only choose 4 images max.</small>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" id="send" class="btn btn-success">Post <img id='gif' src="../img/core-img/loader.gif"></button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
    <script>

    $(document).ready(function(){

        // var pin = prompt("Enter Secret Code");

        // if (pin !== 'kpetigo') {
        //     alert('You are not Delali? You shouldnt be here then')
        //     return false
        // }

        $(function(){
          $(".sidePane a").click(function(){
            $(this).addClass('active').siblings().removeClass('active')
            var page = this.hash.substr(1);
            $.get(page+".php", function(gotHtml){
              $("#content").html(gotHtml);
            });
            return false;
          });
          $('#dash').click();
        });

        $(".row").on('click','li',function(){
            $(this).siblings().fadeOut('slow');
            $('#back').show()
            var page = $(this).attr('data-page')
            $.get(page+".php", function(gotHtml){
              $("#dashContent").html(gotHtml);
            });
            return false;
          });

        $('#back').click(function(){
            window.location.reload()
        })

        submit();

        function submit() {  
            $('.modalForm').on('submit', function(e){  
            e.preventDefault();
            $('#gif').show();
            $('#send').prop('disabled', true);
            $.ajax({  
                    url :"assets/bagPost.php",  
                    method:"POST",  
                    data:new FormData(this),  
                    contentType:false,  
                    processData:false,  
                    success:function(data){ 
                        $('#gif').remove();
                        $('#send').prop('disabled', false); 
                        $('#upIMG').val('');
                        $('.results').html(data);
                        if(data.match('success') !== null){
                            $('.modalForm').slideUp('slow');
                            $('.modal-footer').slideUp('slow'); 
                            setTimeout(function(){ 
                                window.location.reload(); 
                            }, 3000);
                        }
                    }  
            })  
        });  

        }

        $('.row').on('click', '#Yes', function(){
            var cid = $(this).attr('data-cid')
            var tid = $(this).attr('data-tid')
            if(confirm('Are you sure you want to confirm payment?')){
                $.post('assets/conCheckout.php', {
                    ans:'Yes',
                    cid:cid,
                    tid:tid
                    }, function(data){
                    alert(data);
                    window.location.reload(); 
                })
            }else{
                return false
            }
        })

        $('.row').on('click', '#No', function(){
            var cid = $(this).attr('data-cid')
            var tid = $(this).attr('data-tid')
            if(confirm('Are you sure you want to discredit payment?')){
                $.post('assets/conCheckout.php', {
                    ans:'No',
                    cid:cid,
                    tid:tid
                    }, function(data){
                    alert(data);
                    window.location.reload(); 
                })
            }else{
                return false
            }
        })

        $('#bagPost').on('hide.bs.modal', function(){
            window.location.reload();
        })

        $('.row').on('click', '#removeItem', function(){
            var itemNo = $(this).attr('data-item')
            if (confirm("Are you sure you want to delete bag?")) {
            $.post('assets/deleteItem.php',{itemNo:itemNo},function(data){
                alert(data)
                window.location.reload()
            })
            } else {
            return false
            }
        })

        $('.row').on('click', '#activate', function(){
            var ph = $(this).attr('data-ph')
            var p = $(this).attr('data-p')
            if (confirm("Are you sure you want activate client")) {
            $.post('assets/activate.php',{
                ph:ph,
                p:p
                },function(data){
                alert(data)
                window.location.reload()
            })
            } else {
            return false
            }
        })

        $('.row').on('click', '#deleteClient', function(){
            var cid = $(this).attr('data-cid')
            var p = $(this).attr('data-p')
            if (confirm("Are you sure you want delete client")) {
            $.post('assets/deleteClient.php',{
                cid:cid,
                p:p
                },function(data){
                alert(data)
                window.location.reload()
            })
            } else {
            return false
            }
        })

        
    });
    </script>

        </div>
    </div>
    
    <script src="js/bootstrap.js"></script>
</body>
</html>
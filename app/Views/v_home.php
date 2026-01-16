<!-- <h1>Ini Halaman Home</h1>
<h1><?php if (session()->get('level') == 1) {
            echo 'Admin';
            } else if (session()->get('level') == 2) {
            echo 'User';
            } else {
            echo 'Pelangan';
            } 
    ?>
</h1> -->
<div class="col-lg-3 col-xs-6">
<select id="jantina" name="jantina" class="form-control select2" style="width: 100%;">
                    <option value="">--Sila Pilih--</option>                             
                    <option value= "L"   >Lelaki</option>
                    <option value= "P"   >Perempuan</option>  
							</select>

          </div>
<div class="row">

<h3>Laporan Harian</h3>


        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>150</h3>

              <p>Dalam Tindakan</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
             <a href="#" class="small-box-footer"> <i class="fa fa-info-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>53<sup style="font-size: 20px">%</sup></h3>

              <p>Rayuan Baru</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer"> <i class="fa fa-info-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>44</h3>

              <p>Selesai</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer"> <i class="fa fa-info-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>65</h3>

              <p>Dalam Perakuan</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer"> <i class="fa fa-info-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Laporan Bulanan Tahun semasa</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-wrench"></i></button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                  </ul>
                </div>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-8">
                  <p class="text-center">
                    <strong>Bahagian Imigresen</strong>
                  </p>

                  <div class="chart">
                    <!-- Sales Chart Canvas -->
                    <canvas id="salesChart" style="height: 180px;"></canvas>
                  
                  
                  </div>
                  <!-- /.chart-responsive -->
                </div>
                <h3>Rayuan Baru Chart</h3>
                <canvas id="rayuanChart" style="height: 180px;"></canvas>
                <!-- /.col -->
                <div class="col-md-4">
                  <p class="text-center">
                    <strong>Goal Completion</strong>
                  </p>

                  <div class="progress-group">
                    <span class="progress-text">Add Products to Cart</span>
                    <span class="progress-number"><b>160</b>/200</span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-aqua" style="width: 80%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text">Complete Purchase</span>
                    <span class="progress-number"><b>310</b>/400</span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-red" style="width: 80%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text">Visit Premium Page</span>
                    <span class="progress-number"><b>480</b>/800</span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-green" style="width: 80%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text">Send Inquiries</span>
                    <span class="progress-number"><b>250</b>/500</span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-yellow" style="width: 80%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- ./box-body -->
            <div class="box-footer">
              
              <!-- /.row -->
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>




<!-- solid sales graph -->
<div class="box box-solid bg-teal-gradient">
            
            <!-- /.box-body -->
            <div class="box-footer no-border">
              <div class="row">
                <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                  <input type="text" class="knob" data-readonly="true" value="20" data-width="60" data-height="60"
                         data-fgColor="#39CCCC">

                  <div class="knob-label">Rayuan Baru</div>
                </div>
                <!-- ./col -->
                <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                  <input type="text" class="knob" data-readonly="true" value="50" data-width="60" data-height="60"
                         data-fgColor="#39CCCC">

                  <div class="knob-label">Perakuan</div>
                </div>
                <!-- ./col -->
                <div class="col-xs-4 text-center">
                  <input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60"
                         data-fgColor="#39CCCC">

                  <div class="knob-label">Dalam Tindakan</div>
                </div>
                <!-- ./col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
<!-- <input type=date id = KT1> 

<span id = "message1" style="color:red"> </span>  -->

<!-- Choose a date and enter in input field -->
<!-- <button type="reset" onclick = "kiraTempoh1()"> kira tempoh </button>     

<h5 style="color:32A80F" id="kira_tempoh1" ></h5>


                   <script>
                      function kiraTempoh1() {
                          var userinput = document.getElementById("KT1").value;
                          var dob = new Date(userinput);
                          if(userinput==null || userinput=='') {
                            document.getElementById("message1").innerHTML = "**Choose a date please!";  
                            return false; 
                          } else {
                          var month_diff = Date.now() - dob.getTime();
                          var age_dt = new Date(month_diff);  
                          var year = age_dt.getUTCFullYear();
                          var age = Math.abs(year - 1970);
                          return document.getElementById("kira_tempoh1").innerHTML =  
                                  "Age is: " + age + " years. ";
                          }
                      }
                    </script> -->




        <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              <li class="active"><a href="#revenue-chart" data-toggle="tab">Area</a></li>
              <li><a href="#sales-chart" data-toggle="tab">Donut</a></li>
              <li class="pull-left header"><i class="fa fa-inbox"></i> Sales</li>
            </ul>
            <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->
              <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
              <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 500px;"></div>
            </div>
          </div>
    <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">  
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">  
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"> </script>  
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"> </script>    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"> </script>     -->
</head>  
<body>  
  
<input type="text" class="date form-control" data-date-format="yyyy-mm-dd" style="width: 250px;" type="text">  
  
<script type="text/javascript">  
    $('.date').datepicker({  
       format: 'dd/mm/yyyy'  
     });  
</script>  
<div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="date" data-date-format="yyyy-mm-dd" id="datepicker_6"  class="form-control pull-right" id="datepicker">
                </div>
                
<form id="quickForm">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                  </div>
                  <div class="form-group mb-0">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1">
                      <label class="custom-control-label" for="exampleCheck1">I agree to the <a href="#">terms of service</a>.</label>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>




          </div>

 <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.14.0/jquery.validate.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" /> -->
<!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#addMyModal">Open Modal</button>
<div class="modal fade" id="addMyModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Stuff</h4>
      </div>
      <div class="modal-body">
        <form role="form" id="newModalForm">
          <div class="form-group">
            <label class="control-label col-md-3" for="email">A p Name:</label>
            <div class="col-md-9">
              <input type="text" class="form-control" id="pName" name="pName" placeholder="Enter a p name" require/>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3" for="email">Action:</label>
            <div class="col-md-9">
              <input type="text" class="form-control" id="action" name="action" placeholder="Enter and action" require>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success" id="btnSaveIt">Save</button>
            <button type="button" class="btn btn-default" id="btnCloseIt" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div> -->


<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(function() {

$("#newModalForm").validate({
  rules: {
    pName: {
      required: true,
      minlength: 8
    },
    action: "required"
  },
  messages: {
    pName: {
      required: "Please enter some data",
      minlength: "Your data must be at least 8 characters"
    },
    action: "Please provide some data"
  }
});
}); -->


</script>


<!-- <form>
  <input type="text" name="" id="fname">
  <input type="email" name="" id="email">
  <input type="submit" id="submit-btn" class="btn btn-primary" name="answer" value="Simpan" onclick="showDiv()" />
   <input type="submit" id="submit-btn" value="Submit">
</form> -->

<script>
{
  const btn = document.getElementById("submit-btn");
  const fname = document.getElementById("fname");
  const email = document.getElementById("email");
  deactivate()
  
  function activate() {
    btn.disabled = false;
  }
  
  function deactivate() {
    btn.disabled = true;
  }

  function check() {
    if (fname.value != '' && email.value != '' && email.checkValidity()) {
      activate()
    } else {
      deactivate()
    }
  }
  
  btn.addEventListener('click', function(e) {
    alert('submit')
  })
  
  
  fname.addEventListener('input', check)
  email.addEventListener('input', check)
  
}

</script>

<head>
<script>
function ageCalculator() {
    var userinput = document.getElementById("DOB").value;
    var dob = new Date(userinput);
    if(userinput==null || userinput=='') {
      document.getElementById("message").innerHTML = "**Choose a date please!";  
      return false; 
    } else {
    
    //calculate month difference from current date in time
    var month_diff = Date.now() - dob.getTime();
    
    //convert the calculated difference in date format
    var age_dt = new Date(month_diff); 
    
    //extract year from date    
    var year = age_dt.getUTCFullYear();
    
    //now calculate the age of the user
    var age = Math.abs(year - 1970);
    
    //display the calculated age
    return document.getElementById("result").innerHTML =  
             "Age is: " + age + " years. ";
    }
}
</script>
</head>
<!--<body>


 Choose a date and enter in input field 
<b> Enter Date of Birth: <input type=date id = DOB> </b>
<span id = "message" style="color:red"> </span> <br><br>  

< Choose a date and enter in input field 
<button type="submit" onclick = "ageCalculator()"> Calculate age </button> <br><br>
<h1 style="color:32A80F" id="result" ></h1> 

</body>-->




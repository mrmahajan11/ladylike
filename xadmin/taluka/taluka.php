<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Taluka | Lady like</title>

</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <?php
        include "../include/layout.php";
        ?>

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="row">
                <div class="col-md-12 col-xs-12 col-lg-12 no-padding">
                    <div class="col-md-9 col-xs-12 col-lg-9 no-padding">
                        <nav class="breadcrumb">
                            <a class="breadcrumb-item" href="#">Home</a>
                            <a class="breadcrumb-item" href="#">Master</a>
                            <span class="breadcrumb-item active">Taluka</span>
                        </nav>
                    </div>
                    <div class="col-md-3 col-xs-12 col-lg-3">
                        <button class="btn btn-block btn-info waves-effect pull-right btnAddTaluka m-r-0" type="button"
                                id="btnAddTaluka">
                            <i class="fa fa-plus"></i> Add Taluka
                        </button>
                    </div>
                </div>

            </div>
            <div class="clearfix"></div>

            <!--Start Target Div-->
            <div class="row">
                <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                    <div class="divTargetTaluka" id="divTargetTaluka">
                    </div>
                </div>
            </div>
            <!--End Target Div-->
            <div class="row divtalukadatatablecontainer" id="divtalukadatatablecontainer">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Taluka List</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">
                            <table id="datatablemasters" class="table table-striped table-bordered hover order-column"
                                   width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Taluka Sno</th>
                                    <th>Taluka Code</th>
                                    <th>Taluka Name</th>
                                    <th>State Name</th>
                                    <th>Country Name</th>
                                    <th>Action</th>
                                 </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->

        <?php
        include "../include/footer.php";
        ?>
    </div>
</div>
<!-- Datatables -->
<script type="text/javascript">
    var table;
     $(document).ready(function () {

         table = $('#datatablemasters').dataTable({
            "bProcessing": true,
            "sAjaxSource": "ctl_taluka.php?action=getdatatable", // call function to get json format data
            dom: 'Bfrtip'
            , buttons: [ // for export bbutton
                'csv', 'excel', 'pdf'
            ],
            responsive: true,
            "columnDefs": [
                {
                    // Hide first column
                    "targets": [0],
                    "visible": false,
                    "searchable": false
                },
                {width: "15%", targets: 1},
                {width: "25%", targets: 2},
                {width: "25%", targets: 3},
                {width: "25%", targets: 4},
                {width: "5%", targets: 5},
                { targets: 5, orderable: false }
            ],
             "language": { // Display message when no data found for taluka module
                 "emptyTable":"No data available."
             }

        });

         // Open edit mode by clicking data table column
        $('#datatablemasters tbody').on('click', 'td', function ()
        {
           var table = $(this).closest('table').DataTable();
           var data = table.row(this).data();

           // If there are no data in data table
           if(data == "" || data == 'undefined' || data == undefined)
           {
               return false;
           }
           else
           {
               var talukasno = data[0]; // Get the Sno
               var columnindex = $(this).index(); // Get index in which click occur

               // IF click occur on Action column then stop it
               if (columnindex == 4)
               { // provide index of your column in which you prevent row click here is column of 4 index
                   return false;
               }
               else
               {
                   var actionrequest = "edit&talukasno=" + talukasno;
                   GetSetContent("ctl_taluka.php", actionrequest, "divtalukadatatablecontainer", "divTargetTaluka", "btnAddTaluka");
               }
           }

        });

        // Show focus on data table
         $('#datatablemasters tbody').on('mouseenter', 'td', function ()
         {
            var checkdatatablecontent = $(this).text().trim();
            if(checkdatatablecontent != "No data available.")
            {
                var table = $(this).closest('table').DataTable();
                var colIdx = table.cell(this).index().column;
                $(table.cells().nodes()).removeClass('highlight');
                $(table.column(colIdx).nodes()).addClass('highlight');
            }

         });
     });



    /* @use : Add mode of taluka*/
    $("#btnAddTaluka").on("click", function () {
        //Call Function to show add mode of taluka

        /* @use : for show add mode of taluka
        *  @param : 1) ctl_taluka.php : page name
        *  @param : 2) add : Mode
        *  @param : 3) divtalukadatatablecontainer : Hide div ,during add mode
        *  @param : 4) divTargetTaluka : Target div,where add mode will disapay
        *  @param : 5) btnAddTaluka : Button need to disable
        * */
        GetSetContent("ctl_taluka.php", "add", "divtalukadatatablecontainer", "divTargetTaluka", "btnAddTaluka");
    });

</script>
<!-- /Datatables -->
</body>
</html>
<Style>

</Style>
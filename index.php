<html>
<head>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/vis/4.2.0/vis.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>


    <link href="//cdnjs.cloudflare.com/ajax/libs/vis/4.2.0/vis.min.css" rel="stylesheet" type="text/css" />

    <style type="text/css">
        #mynetwork {
            width: 100%;
            height: 100%;
            border: 1px solid lightgray;
        }
    </style>
   <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
</head>
<body>
<div id="mynetwork"></div>
<script type="text/javascript">
	$( document ).ready(function() {
    // create an array with nodes
    var nodes = new vis.DataSet(
	    
<?php
/*
	ini_set('display_startup_errors',1);
	ini_set('display_errors',1);
	error_reporting(-1);
	
*/

	$peoplehandle = fopen("http://docs.google.com/spreadsheets/d/1l1hC8J1PbR9Fzv0rI9OXc9OcXrEYC19f-eL2JJqBvnw/export?gid=0&format=csv", "r");
	while(! feof($peoplehandle))
		{
		$personlist[] = fgetcsv($peoplehandle);
  		}
  	fclose($peoplehandle);
  	$people = array();
  	foreach(array_slice($personlist,1)  as $person) {
	  	if ($person[1] != ''){
			$people[] = array('id' => $person[0], 'label' => $person[1], 'group' => 'people');  
		  	}
  	}
 
 
  	$depthandle = fopen("https://docs.google.com/spreadsheets/d/1l1hC8J1PbR9Fzv0rI9OXc9OcXrEYC19f-eL2JJqBvnw/export?gid=615164215&format=csv", "r");
	while(! feof($depthandle))
		{
		$deptlist[] = fgetcsv($depthandle);
  		}
  	fclose($depthandle);
  	$departments = array();
  	foreach(array_slice($deptlist,1)  as $department) {
	  	if ($department[1] != ''){
			$departments[] = array('id' => $department[0], 'label' => ($department[2] . ' ' . $department[1]), 'group' => 'departments');  
		  	}
  	}
 
 
  	$archandle = fopen("https://docs.google.com/spreadsheets/d/1l1hC8J1PbR9Fzv0rI9OXc9OcXrEYC19f-eL2JJqBvnw/export?gid=1442919662&format=csv", "r");
	while(! feof($archandle))
		{
		$arclist[] = fgetcsv($archandle);
  		}
  	fclose($archandle);
  	$archives = array();
  	foreach(array_slice($arclist,1)  as $archive) {
	  	if ($archive[1] != ''){
			$archives[] = array('id' => $archive[0], 'label' => ($archive[2] . ' ' . $archive[1]), 'group' => 'archives');  
		  	}
  	}
 
 
 
 	
 	$pubhandle = fopen("https://docs.google.com/spreadsheets/d/1l1hC8J1PbR9Fzv0rI9OXc9OcXrEYC19f-eL2JJqBvnw/export?gid=1870068310&format=csv", "r");
	while(! feof($pubhandle))
		{
		$publist[] = fgetcsv($pubhandle);
  		}
  	fclose($pubhandle);
  	$publications = array();
  	foreach(array_slice($publist,1)  as $publication) {
	  	if ($publication[1] != ''){
			$publications[] = array('id' => $publication[0], 'label' => $publication[1], 'group' => 'journals');  
		  	}
  	}
    $allnodes = array_merge($people, $publications, $departments, $archives);

  	print json_encode($allnodes);
    ?>
    );
  

    // create an array with edges
    var edges = new vis.DataSet(
	 <?php 
 	$archivaledgehandle = fopen("https://docs.google.com/spreadsheets/d/1l1hC8J1PbR9Fzv0rI9OXc9OcXrEYC19f-eL2JJqBvnw/export?gid=1266730310&format=csv", "r");
	while(! feof($archivaledgehandle))
		{
		$archivaledgelist[] = fgetcsv($archivaledgehandle);
  		}
  	fclose($archivaledgehandle);
  	$archivaledges = array();
  	foreach(array_slice($archivaledgelist,1)  as $archivaledge) {
		$archivaledges[] = array('from' => $archivaledge[0], 'to' => $archivaledge[1]);  
  	}

 	$pubedgehandle = fopen("https://docs.google.com/spreadsheets/d/1l1hC8J1PbR9Fzv0rI9OXc9OcXrEYC19f-eL2JJqBvnw/export?gid=1878598901&format=csv", "r");
	while(! feof($pubedgehandle))
		{
		$pubedgelist[] = fgetcsv($pubedgehandle);
  		}
  	fclose($pubedgehandle);
  	$pubedges = array();
  	foreach(array_slice($pubedgelist,1)  as $pubedge) {
		$pubedges[] = array('from' => $pubedge[0], 'to' => $pubedge[1]);  
  	}

 	$deptedgehandle = fopen("https://docs.google.com/spreadsheets/d/1l1hC8J1PbR9Fzv0rI9OXc9OcXrEYC19f-eL2JJqBvnw/export?gid=1494772489&format=csv", "r");
	while(! feof($deptedgehandle))
		{
		$deptedgelist[] = fgetcsv($deptedgehandle);
  		}
  	fclose($deptedgehandle);
  	$deptedges = array();
  	foreach(array_slice($deptedgelist,1)  as $deptedge) {
		$deptedges[] = array('from' => $deptedge[0], 'to' => $deptedge[1]);  
  	}
	
	$alledges = array_merge($archivaledges, $pubedges, $deptedges);




	print json_encode($alledges);
	
	
	?>
	
	     );

    // create a network
    var container = document.getElementById('mynetwork');

    // provide the data in the vis format
    var data = {
        nodes: nodes,
        edges: edges
    };
    var options = {
	    autoResize: true,
			
		groups: {
          people: {
            shape: 'icon',
            icon: {
              face: 'FontAwesome',
              code: '\uf007',
            }
          },
          departments: {
            shape: 'icon',
            icon: {
              face: 'FontAwesome',
              code: '\uf19c',
            }
          },
          archives: {
            shape: 'icon',
            icon: {
              face: 'FontAwesome',
              code: '\uf187',
            }
          },
          journals: {
            shape: 'icon',
            icon: {
              face: 'FontAwesome',
              code: '\uf02d',
            }
          }
	    }
		};
    // initialize your network!
    var network = new vis.Network(container, data, options);
    
    
    
   		$(window).resize(function(){
    		$("div#mynetwork").width($(window).width());
    		$("div#mynetwork").height($(window).height());
    		network.redraw();
		});
	});
</script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
  
<?php include('head.php'); ?>

 <?php $page = 'reports'; include('menu.php'); ?>   

    <div class="container">

            <!-- Jumbotron -->
      <div class="jumbotron">
        <h1>SkiAlp Reports</h1>
        <p class="lead">Sciare informati</p>
      </div>



	<div class="panel panel-default">
	<div class="panel-heading"><h3 class="panel-title section-title">Reports</h3>
    </div>
	  <div class="panel-body">
	   	<!-- Example row of columns -->
	        <div class="rows">
			</div>
            
		  </div>
        
    </div>
		  	<script type="text/template" id="report-list-template">
			
			 <% _.each(reports, function(report,index){  %>
				<% if(index%2==0) { %>
				  <div class="row" >
				<% } %>
				
				
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h2 class="panel-title"><%= report.get('NAME') %> <small><%= report.get('FINE') %> m</small></h2></div>
							<div class="panel-body">
								 
								<div class="row" >
								<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
									<ul class="list-unstyled">
									<li><strong><%= report.get('CREATED_ON')%></strong></li>
									  <li><strong><%= report.get('AUTHOR')%></strong></li>
									<li><span class="hidden-xs">Regione: </span><strong><%= report.get('REGION')%></strong></li>
									<li><span class="hidden-xs">Partenza: </span><strong><%= report.get('INIZIO')%></strong></li>
								    <li><span class="hidden-xs">Dislivello: </span><strong><%= report.get('GAIN')%> m</strong></li>
												<li><span class="hidden-xs">Neve: </span><strong><%= report.get('PRIMARY_SNOW')%> - <%= report.get('SECONDARY_SNOW')%></strong></li>
													<li><span class="hidden-xs">Rischio: </span>

														<% if (report.get('RISK').substring(0, 1) == "5") { %>
														    <span class="label label-danger">
														<% } %>
												   	<% if (report.get('RISK').substring(0, 1) == "4") { %>
													    <span class="label label-danger">
													<% } %>
												 		<% if (report.get('RISK').substring(0, 1) == "3") { %>
														    <span class="label label-warning">
														<% } %>
														<% if (report.get('RISK').substring(0, 1) == "2") { %>
														    <span class="label label-info">
														<% } %>
														<% if (report.get('RISK').substring(0, 1) == "1") { %>
														    <span class="label label-success">
														<% } %>
												     <%= report.get('RISK')%></span></li>				
									</ul>
								</div>
						  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 myclass">		
				  				<% if (report.get('IMAGES')) {%>
								<a href="#myImageModal<%=report.get('ID')%>" role="button"  data-toggle="modal" data-target="#myImageModal<%=report.get('ID')%>">
								<img src="<%= report.get('IMAGES').substring(0,report.get('IMAGES').indexOf(';') ) %>" class="img-rounded img-responsive no-margin" alt="Responsive image"> 			
									</a>
									
							   <% }  else{ %>
									
			<img src="http://placehold.it/125x95&text=Nessuna+Immagine" class="img-rounded img-responsive no-margin" alt="Responsive image">	
				<%}%>
							
								
								
								
								
								
								
									<!-- Modal -->
									<div class="modal fade" id="myImageModal<%=report.get('ID')%>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									  <div class="modal-dialog">
									    <div class="modal-content">
									      <div class="modal-header">
									        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									        <h4 class="modal-title" id="myModalLabel"><small><%= report.get('CREATED_ON') %> </small> <%= report.get('NAME') %> <small><%= report.get('FINE') %> m</small> </h4>
									      </div>
									      <div class="modal-body">
										<div id="carousel-example-generic<%=report.get('ID')%>" class="carousel slide" data-ride="carousel">
										  <!-- Indicators -->
										  <ol class="carousel-indicators">
										
										<%if (report.get('IMAGES')) {	var a = report.get('IMAGES').split(";");

											for (i = 0; i < a.length-1; i++) { 
												%>
												<li data-target="#carousel-example-generic<%=report.get('ID')%>" data-slide-to="<%= i %>" class="<% if (i==0){ %>active <% }%> "></li>
											
										 <%	} } %>
								
										  </ol>

										  <!-- Wrapper for slides -->
										  <div class="carousel-inner">
										    
										
										<%if (report.get('IMAGES')) {	var a = report.get('IMAGES').split(";");

											for (i = 0; i < a.length-1; i++) { 
												%>
												<div class="item <% if (i==0){ %>active <% }%> ">
												<img src="<%= a[i].replace("/cache","") %>" class="img-rounded img-responsive no-margin">
											    </div>
										 <%	} } %>

										  </div>





										  <!-- Controls -->
										  <a class="left carousel-control" href="#carousel-example-generic<%=report.get('ID')%>" data-slide="prev">
										    <span class="glyphicon glyphicon-chevron-left"></span>
										  </a>
										  <a class="right carousel-control" href="#carousel-example-generic<%=report.get('ID')%>" data-slide="next">
										    <span class="glyphicon glyphicon-chevron-right"></span>
										  </a>
										</div>		

									      </div>
									      <div class="modal-footer">
									        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									      </div>
									    </div><!-- /.modal-content -->
									  </div><!-- /.modal-dialog -->
									</div><!-- /.modal -->
								
								
								<br>
								<!-- Button trigger modal -->
								<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal<%= report.get('ID')%>">
								  Dettagli
								</button>

								<!-- Modal -->
								<div class="modal fade" id="myModal<%=report.get('ID')%>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								  <div class="modal-dialog">
								    <div class="modal-content">
								      <div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								        <h4 class="modal-title" id="myModalLabel"><small><%= report.get('CREATED_ON') %> </small> <%= report.get('NAME') %> <small><%= report.get('FINE') %> m</small> </h4>
								      </div>
								      <div class="modal-body">
											<div class="row" >
												<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
													<ul class="list-unstyled">
													<li><strong><%= report.get('AUTHOR')%></strong></li>
													<li><span class="hidden-xs">Regione: </span><strong><%= report.get('REGION')%></strong></li>
													<li><span class="hidden-xs">Partenza: </span><strong><%= report.get('INIZIO')%></strong></li>
												    <li><span class="hidden-xs">Dislivello: </span><strong><%= report.get('GAIN')%> m</strong></li>
													<li><span class="hidden-xs">Neve: </span><strong><%= report.get('PRIMARY_SNOW')%> - <%= report.get('SECONDARY_SNOW')%></strong></li>
																	<li><span class="hidden-xs">Rischio: </span>
																		<% if (report.get('RISK').substring(0, 1) == "5") { %>
																		    <span class="label label-danger">
																		<% } %>
																   	<% if (report.get('RISK').substring(0, 1) == "4") { %>
																	    <span class="label label-danger">
																	<% } %>
																 		<% if (report.get('RISK').substring(0, 1) == "3") { %>
																		    <span class="label label-warning">
																		<% } %>
																		<% if (report.get('RISK').substring(0, 1) == "2") { %>
																		    <span class="label label-info">
																		<% } %>
																		<% if (report.get('RISK').substring(0, 1) == "1") { %>
																		    <span class="label label-success">
																		<% } %>
																     <%= report.get('RISK')%></span></li>				
													</ul>
												</div>
												<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
													<ul class="list-unstyled">
													<li><span class="hidden-xs">Salita: </span><strong><%= report.get('ASCENT')%></strong></li>
													<li><span class="hidden-xs">Discesa: </span><strong><%= report.get('DESCENT')%></strong></li>
													<li><span class="hidden-xs">Difficoltà: </span><strong><%= report.get('DIFFICULTY')%></strong></li>
												    <li><span class="hidden-xs">Dislivello: </span><strong><%= report.get('GAIN')%> m</strong></li>
													<li><span class="hidden-xs">Condizioni: </span><strong><%= report.get('STATUS')%> - <%= report.get('RATING')%></strong></li>				
													<li><span class="hidden-xs">Itinerari: </span><strong><%= report.get('ITINERARY')%></strong></li>
																			
													</ul>
												</div>
												</div>
										<div class="row" >		
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
										<%= report.get('COMMENT') %>
								    	</div>
							        	</div>
								
								
								      </div>
								      <div class="modal-footer">
								        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								      </div>
								    </div><!-- /.modal-content -->
								  </div><!-- /.modal-dialog -->
								</div><!-- /.modal -->	
						</div>
						</div>
					      </div> 
			          </div>    
					</div>
						<% if(index%2==1) { %>
						  </div>
						<div class="clearfix "></div>
						<% } %>
					<%	}); %>
			</script>		
			 



	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"> </script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"> </script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.1.0/backbone-min.js"> </script>
	<script>
	
		$.ajaxPrefilter(function(options,originalOptions,jqXHR){
		 options.url = '' + options.url;	
		});
		
		$.fn.serializeObject = function() {
		  var o = {};
		  var a = this.serializeArray();
		  $.each(a, function() {
		      if (o[this.name] !== undefined) {
		          if (!o[this.name].push) {
		              o[this.name] = [o[this.name]];
		          }
		          o[this.name].push(this.value || '');
		      } else {
		          o[this.name] = this.value || '';
		      }
		  });
		  return o;
		};
	

		var Reports = Backbone.Collection.extend({
		    url: function () {
                return '/rest-php/reports?page=' + this.page + ''
            },
            page:0
		});
	    var Report = Backbone.Model.extend({
		  
		});
		var ReportList = Backbone.View.extend({
          el: $(".rows"),
          initialize:function(){
            this.isLoading = false;
            this.reports = new Reports();
            _.bindAll(this, 'checkScroll');
            $(window).scroll(this.checkScroll);
		  },
          render: function(){
		    this.loadResults(); 
		  },
          loadResults: function(){  
			this.isLoading = true;
            var CopyThis = this;
			this.reports.fetch({
			  success:function(reports){
                CopyThis.isLoading = false;
				var template = _.template($('#report-list-template').html(), {reports: reports.models});	
			    $(CopyThis.el).append(template);
              }
            
			});
        },
   
        // This will simply listen for scroll events on the current el
    events: {
      "scroll": "checkScroll",
      "click .more":"loadMore"
    },
    checkScroll: function () {
      var triggerPoint = 100; // 100px from the bottom
      if( !this.isLoading && $(window).scrollTop() + $(window).height() > $(document).height() - 250 ) {
        this.reports.page += 1; // Load next page
        console.log(this.reports.page);
        this.loadResults();
      }
    },
    loadMore :function(){
      console.log("loadMore");
      this.reports.page += 1; // Load next page
      console.log(this.reports.page);
      this.loadResults();
    },
    close: function() {
    	_.each(this.subViews, function(view) { view.remove(); });
		this.remove();
	}
    
    });
	
		
	
		var Router = Backbone.Router.extend({
			routes: {
				"": "reports",
                "reports":"reports",
                "reports/:id":"reportDetails",
           //     "utenti":"users"
			},
            reports:function(){
                this.reportList = new ReportList();
                switchActive("Reports");
                this.reportList.render();
            }
            
		});
		
		var router = new Router();
		Backbone.history.start();
        
        function switchActive(menu){
        $('.nav li').removeClass('active');
        $('.section-title').html(menu);
        $('.nav a:contains(' + menu+ ')').parent().addClass('active');

        }
        
	</script>


<?php $technologies = 'PHP, HTML, CSS, Javascript, Twitter Bootstrap'; include('footer.php'); ?>   

    </div><!-- /.container -->


    <?php include('import.php'); ?>
  </body>
</html>

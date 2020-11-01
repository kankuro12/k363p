<div class="row">
    <div class="col-12 d-flex no-block align-items-center">
        
        <div class="ml-auto text-right">
            <nav aria-label="breadcrumb">
            	<ol class="breadcrumb">
            	@for($i = 0; $i <= count(Request::segments()); $i++)
            	<li class="breadcrumb-item">
            	  <a href="">{{title_case(Request::segment($i))}}</a>
            	</li>
            	@endfor
                </ol>                
            </nav>
        </div>
    </div>
</div>


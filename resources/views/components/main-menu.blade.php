<section class="tr-maincontent background">
    <div class="container ">
        <nav class="navbar navbar-expand-lg background-danger">
            <div class="container-fluid">
              
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    @foreach ($listmenu as $itemmenu)
                        <x-main-menu-item :itemmenu="$itemmenu"/>
                    @endforeach

                  
                  
                    
                  
                  
                </ul>

              </div>
            </div>
          </nav>
    </div>
</section>
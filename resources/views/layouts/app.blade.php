<!DOCTYPE html>
<html lang="en">
    <head>
        @include('partials._assets', ['title' => $title])
    </head>
    <body>
            @yield('sidebar_nav')
            <div class="content">
                <section class="container">
                    @yield('content')
                    
                    @include('layouts.partials._back_to_top')
                </section><!-- ./container -->
            </div><!-- /.content -->
        <div id="page-overlay"></div>
    </body>
</html>

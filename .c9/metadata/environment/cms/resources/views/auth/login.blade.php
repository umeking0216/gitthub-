{"filter":false,"title":"login.blade.php","tooltip":"/cms/resources/views/auth/login.blade.php","ace":{"folds":[],"scrolltop":495,"scrollleft":0,"selection":{"start":{"row":60,"column":6},"end":{"row":60,"column":6},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":0},"hash":"91eca8cc38e1686033d66521fdd1afdcb8609eff","mime":"application/octet-stream","undoManager":{"mark":1,"position":1,"stack":[[{"start":{"row":46,"column":17},"end":{"row":47,"column":0},"action":"insert","lines":["",""],"id":2},{"start":{"row":47,"column":0},"end":{"row":48,"column":0},"action":"insert","lines":["",""]}],[{"start":{"row":48,"column":0},"end":{"row":60,"column":6},"action":"insert","lines":["@if (Route::has('login'))","    <div class=\"hidden fixed top-0 right-0 px-6 py-4 sm:block\">","        @auth","            <a href=\"{{ url('/dashboard') }}\" class=\"text-sm text-gray-700 dark:text-gray-500 underline\">Dashboard</a>","        @else","            <a href=\"{{ route('login') }}\" class=\"text-sm text-gray-700 dark:text-gray-500 underline\">Log in</a>","","            @if (Route::has('register'))","                <a href=\"{{ route('register') }}\" class=\"ml-4 text-sm text-gray-700 dark:text-gray-500 underline\">Register</a>","            @endif","        @endauth","    </div>","@endif"],"id":3}]]},"timestamp":1675871341629}
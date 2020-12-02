<nav>
    <ul>
        <li class=" {{ setLinkActivo('home') }} "><a  href="{{ route('home') }}">Home</a></li>
        <li class=" {{ setLinkActivo('contacto') }} "><a href="<?php echo route('contacto'); ?>">Contacto</a></li>
        <li class=" {{ request()->routeIs('about') ? 'active' : '' }} "><a href="<?php echo route('about'); ?>">About</a></li>
        <li class=" {{ request()->routeIs('portfolio') ? 'active' : '' }} "><a href="<?php echo route('portfolio'); ?>">Portfolio</a></li>
        
        <li class=" {{ setLinkActivo('twitch') }} "><a  href=" {{ route('twitch') }} ">Twitch</a></li>
      
        
        <form action="{{ route('search') }}" method="POST">
            @csrf <!-- proteccion contra xxs, agrega un token -->
            <input type="text" name="search" placeholder="¡A buscar!" minlength="1" maxlength="20" size="20">
            <button>¡Dale!</button>
        </form>
    </ul>
</nav>
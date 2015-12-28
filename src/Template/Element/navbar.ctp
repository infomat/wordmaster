<div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">Word Master</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
      <!--<li><a href="/">Home <span class="sr-only">(current)</span></a></li>-->

      <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Word <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="/Words/add">Add New Word</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="/Words">Word List</a></li>
            <li><a href='/Words/index/0'>All Word List</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="/Tags">Tag List</a></li>
          </ul>		          
      </li>
      <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">My Journal<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="/Diarys/add">Write Journal</a></li>
            <li><a href="/Diarys">Journal List</a></li>
          </ul>		          
      </li>
      <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dictionaries<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="http://endic.naver.com/?sLn=en" target="_blank">Naver</a></li>
            <li><a href="http://www.macmillandictionary.com/" target="_blank">Macmillan</a></li>
          </ul>		          
      </li>
      <li><a href="#">Game</a></li>
      
      <form class="navbar-form navbar-left" role="search">
        <div id="searchbox" class="form-group">
          <input type="text" class="form-control" placeholder="Search Word">
          <button id="search" type="submit" class="btn btn-success">Search</button>
        </div>
      </form>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="/pages/about">History</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">My Account <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <?php 
              if (is_null($this->request->session()->read('Auth.User.id'))) {
                echo "<li><a href='/users/login'>Login</a></li>";  
              } else{
                if($this->request->session()->read('Auth.User.role') == 'user'){
                  echo "<li><a href='/users/profile'>My Profile</a></li>";
                  echo "<li><a href='/users/edit/" . $this->request->session()->read('Auth.User.id') . "'>Edit Profile</a></li>";
                }else{
                  echo "<li><a href='/users/userlist/'>User List</a></li>";
                  echo "<li><a href='/users/add/'>Add User</a></li>";
                }
                  echo "<li role='separator' class='divider'></li>"; 
                  echo "<li>" . $this->Html->link('Log Out', ['controller' => 'Users', 'action' => 'logout']) . "</li>";
              }
            ?>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
</div><!-- /.container-fluid -->
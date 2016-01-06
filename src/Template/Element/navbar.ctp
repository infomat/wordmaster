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
            <li><a href="/Words">My Words</a></li>
            <li><a href="/Words/index/0">My Completed Words</a></li>
            <li><a href='/Words/index/1'>All Words</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="/Tags">Tag List</a></li>
          </ul>		          
      </li>
      <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">My Article<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="/Diarys/add">Write Article</a></li>
            <li><a href="/Diarys">My Article List</a></li>
          </ul>		          
      </li>
      <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dictionaries<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="http://endic.naver.com/?sLn=en" target="_blank">Naver</a></li>
            <li><a href="http://www.thesaurus.com/" target="_blank">Thesaurus.com</a></li>
            <li><a href="http://dictionary.reference.com/" target="_blank">Dictionary.com/</a></li>
            <li><a href="http://www.macmillandictionary.com/" target="_blank">Macmillan</a></li>
          </ul>		          
      </li>
      <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Competition<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="/Words/game1">Review</a></li>
            <li><a href="/Users/profile">Rank</a></li>
            <li role='separator' class='divider'></li>
            <li><a href="/Diarys/index/1">Articles about English</a></li>
          </ul>		          
      </li>
      
      <form class="navbar-form navbar-left" role="search" action="/Words/search">
        <div id="searchbox" class="form-group">
          <input type="text" class="form-control" name="searchword" placeholder="Search Word">
          <button id="search" type="submit" class="btn btn-success">Search</button>
        </div>
      </form>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">English Study<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="http://web2.uvcs.uvic.ca/courses/elc/studyzone/" target="_blank">ESL Study Zone</a></li>
            <li><a href="http://www.usalearns.org/student-home" target="_blank">USA Learns</a></li>
            <li><a href="http://www.eflnet.com/" target="_blank">ESL Practice</a></li>
            <li><a href="http://www.englishpage.com/index.html" target="_blank">Free Online ESL Course</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="http://www.englishaccentcoach.com/index.aspx" target="_blank">Accent Coach</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="http://chompchomp.com/exercises.htm" target="_blank">Exercise Grammar Bytes</a></li>
            <li><a href="http://grammar.ccc.commnet.edu/grammar/index2.htm" target="_blank">Grammar Exercise</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="http://ed.ted.com/lessons/comma-story-terisa-folaron" target="_blank">Comma Story</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="hhttp://esl.about.com/od/learningtechniques/fl/How-to-Use-a-Thesaurus-for-English-Learners.htm" target="_blank">How to improve vocabulary</a></li>
            <li><a href="https://owl.english.purdue.edu/" target="_blank">Purdue Online Writing</a></li>
            <li><a href="http://www.edb.utexas.edu/minliu/pbl/ESOL/" target="_blank">Writing five paragraph essay</a></li>
          </ul>		          
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php if (is_null($this->request->session()->read('Auth.User.name'))) {echo __('My Account');} else {echo $this->request->session()->read('Auth.User.name');} ?><span class="caret"></span></a>
          <ul class="dropdown-menu">
            <?php 
              if (is_null($this->request->session()->read('Auth.User.id'))) {
                echo "<li><a href='/users/login'>Login</a></li>";
                echo "<li><a href='/users/signup'>Sign Up</a></li>";  
              } else{
                if ($this->request->session()->read('Auth.User.role') == 'user'){
                  echo "<li><a href='/users/view/".$this->request->session()->read('Auth.User.id')."'>My Profile</a></li>";
                  echo "<li><a href='/users/edit/" . $this->request->session()->read('Auth.User.id') . "'>Edit Profile</a></li>";
                  echo "<li role='separator' class='divider'></li>"; 
                  echo "<li><a href='/historys/'>History</a></li>";
                  echo "<li><a href='/points/index'>List Points</a></li>";
                } else{
                  echo "<li><a href='/users/index/'>User List</a></li>";
                  echo "<li><a href='/users/add/'>Add User</a></li>";
                  echo "<li role='separator' class='divider'></li>";
                  echo "<li><a href='/points/index'>List Points</a></li>";
                  echo "<li><a href='/Users/profile'>Rank</a></li>";
                  echo "<li><a href='/points/add'>Add Points</a></li>";
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
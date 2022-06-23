
    <footer >
      <nav class="NavBasDroite">
        <?php
        if(isset($_SESSION['role'])) {
          $nav->affichageNav($_SESSION['role'], 1);
        } else {
          $nav->affichageNav(0, 1);
        }
         ?>
      </nav>
      Copyrigth &copy; <?=date('Y')?> &nbsp;

    </footer>

   </body>
 </html>

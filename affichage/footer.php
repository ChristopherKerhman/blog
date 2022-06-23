
    <footer>
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
      <a class="lienNav" href="https://github.com/ChristopherKerhman/blog" target="_blank">Lien vers le Github du projet</a>
    </footer>

   </body>
 </html>

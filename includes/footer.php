<?php
/**
 * ============================================================================
 * Fichier : includes/footer.php
 * Projet  : Catalogue dynamique « Médiathèque IPNET »
 * UE      : IT 231 - Développement Web I
 * Niveau  : Licence 2 (GL, WIM, DWM, IG, IA)
 * Auteur  : DJELOU Komi Noé (Licence IG)
 * Année   : 2026 - 2027
 * ============================================================================
 * Description :
 * Pied de page commun à l'ensemble du site.
 * Clôture les balises principales et affiche les mentions académiques
 * ainsi que le copyright dynamique.
 * ============================================================================
 */
?>
        </div><!-- Fin du .container -->
    </main><!-- Fin du .site-main -->

    <!-- ===================================================================== -->
    <!-- PIED DE PAGE INSTITUTIONNEL                                           -->
    <!-- ===================================================================== -->
    <footer class="site-footer">
        <div class="footer-container">
            
            <div class="footer-col">
                <h4 class="footer-heading">Médiathèque IPNET</h4>
                <p class="footer-text">
                    Plateforme pédagogique de consultation documentaire de l'Institut IPNET.
                    Conçue pour accompagner la formation des étudiants en technologies de l'information.
                </p>
                <p class="footer-subtext">Lomé - République Togolaise</p>
            </div>

            <div class="footer-col">
                <h4 class="footer-heading">Navigation Rapide</h4>
                <ul class="footer-links">
                    <li><a href="index.php">Page d'accueil</a></li>
                    <li><a href="catalogue.php">Catalogue complet</a></li>
                    <li><a href="apropos.php">À propos du projet</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4 class="footer-heading">Cadre Académique</h4>
                <p class="footer-text">
                    <strong>UE :</strong> IT 231 - Développement Web I<br>
                    <strong>Enseignant :</strong> M. EDOU Dodji<br>
                    <strong>Étudiant :</strong> DJELOU Komi Noé (Licence IG)<br>
                    <strong>Année académique :</strong> 2026 - 2027
                </p>
            </div>

        </div>

        <div class="footer-bottom">
            <div class="footer-bottom-container">
                <p>&copy; <?php echo date('Y'); ?> IPNET Institute of Technology. Tous droits réservés.</p>
                <p class="footer-tech-note">Mini-projet 1 - PHP Procédural &amp; HTML5 / CSS3</p>
            </div>
        </div>
    </footer>

</body>
</html>

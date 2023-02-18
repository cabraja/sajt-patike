<?php
include "views/fixed/header.php";
include "views/fixed/nav.php";
?>

<?php
include "models/functions/functions.php";

if(isset($_SESSION['user'])):
?>
    <!--MODAL-->
    <div class="modal fade" id="contact-modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Patike.rs</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="contact-modal-text">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zatvori</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-5">
        <div class="row justify-content-center d-flex">
            <div class="col-12 col-lg-7">
                <h2 class="fw-bold">Kontakt stranica</h2>
                <p class="text-secondary">Ukoliko imate bilo kakva pitanja, sugestije ili kritike, možete nas kontaktirati putem kontakt forme ispod.
                    Naši zaposleni će vam rado odgovoriti u što je moguće kraćem roku.</p>
                <hr />
                <form>
                    <div class="mb-3">
                        <label for="subject" class="form-label">Naslov</label>
                        <input type="email" class="form-control" id="subject" name="subject">
                        <small class="text-danger"></small>
                    </div>
                    <div class="mb-3">
                        <label for="body" class="form-label">Poruka</label>
                        <textarea class="form-control" id="body" rows="3" name="body"></textarea>
                        <small class="text-danger"></small>
                    </div>

                    <button type="button" id="send-message-btn" class="btn btn-primary mx-auto d-block px-5">Pošalji</button>
                </form>
            </div>
        </div>
    </div>

    <script src="assets/js/contact.js"></script>
<?php
else:
?>
    <div class="container">
        <div class="alert alert-secondary mx-auto my-5 text-center" role="alert">
            Ulogujte se da bi ste poslali poruku!
        </div>
    </div>

<?php
endif;
?>


<?php
include "views/fixed/footer.php";
?>

<style>
	header.masthead {
            background-image: url('busimg5.jpg.jpg');
            background-size: cover;
            background-position: center;
            padding: 280px 0;
        }
	
  
  .fade-in {
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.5s ease, transform 0.5s ease;
  }

  .fade-in.active {
    opacity: 1;
    transform: translateY(0);
  }
  .card {
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
  color: #000;
}
.btn:hover {
  transform: scale(1.1);
  transition: transform 0.3s ease;
}
.card {
  transition: transform 0.4s ease;
}

.card:hover {
  transform: translateY(-5px);
}
/* Example background gradient */
.section {
  background: linear-gradient(to bottom, #ffffff, #f0f0f0);
}
/* Example background image */
#about {
  background-image: url('img.jpg');
  background-size: cover;
  background-position: center;
}
/* Example overlay */

/* Example background gradient */
#contact {
  background: linear-gradient(to bottom, #ffffff, #f0f0f0);
}
/* Example form styling */
#contactForm input[type="text"],
#contactForm input[type="email"],
#contactForm textarea {
  width: 100%;
  padding: 10px;
  margin-bottom: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
  box-sizing: border-box;
}

#contactForm textarea {
  height: 150px;
}
/* Example button animation */
#submitButton {
  background-color: #007bff;
  color: #fff;
  transition: background-color 0.3s ease;
}

#submitButton:hover {
  background-color: #0056b3;
}
/* Example form validation animation */
.invalid-input {
  border-color: #ff0000 !important;
  animation: shake 0.5s;
}

@keyframes shake {
  0% { transform: translateX(0); }
  25% { transform: translateX(-5px); }
  50% { transform: translateX(5px); }
  75% { transform: translateX(-5px); }
  100% { transform: translateX(0); }
}
// Example Scroll Reveal animation with ScrollReveal library
ScrollReveal().reveal('#contactForm', { delay: 300, distance: '50px', origin: 'bottom', easing: 'ease-in' });
#contactForm input[type="text"],
#contactForm input[type="email"],
#contactForm textarea {
  color: #333; /* Your custom color */
}
/* Example form label color */
#contactForm label {
  color: #555; /* Your custom color */
}
/* Example subheading font color */
#contact h3.section-subheading {
  color: #666; /* Your custom color */
}
/* Example text color for input fields */
#contactForm input[type="text"],
#contactForm input[type="email"],
#contactForm textarea {
  color: #333; /* Your desired text color */
}
.masthead {
    background-image: url('bus.jpg'); /* Replace 'path/to/your/image.jpg' with the actual path to your image */
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    padding: 100px 0; /* Adjust padding as needed */
    text-align: center;
  }
  
  .masthead-subheading {
    color: #fff; /* Set text color for the headings */
  }
  
		::placeholder {
            color: red; /* Set font color to black */
        }
		.contact-form {
    max-width: 800px;
    margin: 0 auto;
}

.input-field {
    border: 2px solid #ccc;
    border-radius: 5px;
    padding: 10px;
    width: 100%;
    margin-bottom: 20px;
    transition: border-color 0.3s ease-in-out;
}

.input-field:focus {
    border-color: #007bff;
}

.submit-button {
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 15px 30px;
    font-size: 18px;
    cursor: pointer;
    transition: background-color 0.3s ease-in-out;
}

.submit-button:hover {
    background-color: #0056b3;
}

/* Add animations */
.input-field,
.submit-button {
    animation: slideIn 1s ease forwards;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(50px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}





</style>
<!-- Masthead-->
<header class="masthead">
	<div class="container">
		<div class="masthead-subheading" >Welcome To TCS- Service</div>
		<div class="masthead-heading text-uppercase">Explore our Tour Packages</div>
		<a class="btn btn-primary btn-xl text-uppercase" href="journals.html">View Tours</a>
	</div>
</header>
<!-- Services-->
<section class="page-section bg-dark" id="home">
	<div class="container">
		<h2 class="text-center">Tour Packages</h2>
	<div class="d-flex w-100 justify-content-center">
		<hr class="border-warning" style="border:3px solid" width="15%">
	</div>
	<div class="row">
		<?php
		$packages = $conn->query("SELECT * FROM `packages` order by rand() limit 3");
			while($row = $packages->fetch_assoc() ):
				$cover='';
				if(is_dir(base_app.'uploads/package_'.$row['id'])){
					$img = scandir(base_app.'uploads/package_'.$row['id']);
					$k = array_search('.',$img);
					if($k !== false)
						unset($img[$k]);
					$k = array_search('..',$img);
					if($k !== false)
						unset($img[$k]);
					$cover = isset($img[2]) ? 'uploads/package_'.$row['id'].'/'.$img[2] : "";
				}
				$row['description'] = strip_tags(stripslashes(html_entity_decode($row['description'])));

				$review = $conn->query("SELECT * FROM `rate_review` where package_id='{$row['id']}'");
				$review_count =$review->num_rows;
				$rate = 0;
				while($r= $review->fetch_assoc()){
					$rate += $r['rate'];
				}
				if($rate > 0 && $review_count > 0)
				$rate = number_format($rate/$review_count,0,"");
		?>
			<div class="col-md-4 p-4 ">
				<div class="card w-100 rounded-0">
					<img class="card-img-top" src="<?php echo validate_image($cover) ?>" alt="<?php echo $row['title'] ?>" height="200rem" style="object-fit:cover">
					<div class="card-body">
					<h5 class="card-title truncate-1 w-100"><?php echo $row['title'] ?></h5><br>
					<div class=" w-100 d-flex justify-content-start">
						<div class="stars stars-small">
								<input disabled class="star star-5" id="star-5" type="radio" name="star" <?php echo $rate == 5 ? "checked" : '' ?>/> <label class="star star-5" for="star-5"></label> 
								<input disabled class="star star-4" id="star-4" type="radio" name="star" <?php echo $rate == 4 ? "checked" : '' ?>/> <label class="star star-4" for="star-4"></label> 
								<input disabled class="star star-3" id="star-3" type="radio" name="star" <?php echo $rate == 3 ? "checked" : '' ?>/> <label class="star star-3" for="star-3"></label> 
								<input disabled class="star star-2" id="star-2" type="radio" name="star" <?php echo $rate == 2 ? "checked" : '' ?>/> <label class="star star-2" for="star-2"></label> 
								<input disabled class="star star-1" id="star-1" type="radio" name="star" <?php echo $rate == 1 ? "checked" : '' ?>/> <label class="star star-1" for="star-1"></label> 
						</div>
                    </div>
    				<p class="card-text truncate"><?php echo $row['description'] ?></p>
					<div class="w-100 d-flex justify-content-end">
						<a href="./?page=view_package&id=<?php echo md5($row['id']) ?>" class="btn btn-sm btn-flat btn-warning">View Package <i class="fa fa-arrow-right"></i></a>
					</div>
					</div>
				</div>
			</div>
		<?php endwhile; ?>
	</div>
	<div class="d-flex w-100 justify-content-end">
		<a href="./?page=packages" class="btn btn-flat btn-warning mr-4">Explore Package <i class="fa fa-arrow-right"></i></a>
	</div>
	</div>
</section>
<!-- About-->
<section class="page-section" id="about">
	<div class="container">
		<div class="text-center">
			<h2 class="section-heading text-uppercase">About Us</h2>
		</div>
		<div>
			<div class="card w-100">
				<div class="card-body">
					<?php echo file_get_contents(base_app.'about.html') ?>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Contact-->
<section class="page-section" id="contact">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Contact Us</h2>
            <h3 class="section-subheading text-muted">Send us a message for inquiries.</h3>
        </div>
        <!-- * * * * * * * * * * * * * * *-->
        <!-- * * SB Forms Contact Form * *-->
        <!-- * * * * * * * * * * * * * * *-->
        <!-- This form is pre-integrated with SB Forms.-->
        <!-- To make this form functional, sign up at-->
        <!-- https://startbootstrap.com/solution/contact-forms-->
        <!-- to get an API token!-->
        <form id="contactForm" >
            <div class="row align-items-stretch mb-5">
                <div class="col-md-6">
                    <div class="form-group">
                        <!-- Name input-->
                        <input class="form-control" id="name" name="name" type="text" placeholder="Your Name *" required />
                    </div>
                    <div class="form-group">
                        <!-- Email address input-->
                        <input class="form-control" id="email" name="email" type="email" placeholder="Your Email *" data-sb-validations="required,email" />
                    </div>
                    <div class="form-group mb-md-0">
                        <input class="form-control" id="subject" name="subject" type="subject" placeholder="Subject *" required />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group form-group-textarea mb-md-0">
                        <!-- Message input-->
                        <textarea class="form-control" id="message" name="message" placeholder="Your Message *" required></textarea>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <button class="btn btn-primary btn-xl text-uppercase" id="submitButton" type="submit">Send Message</button>
                <!-- Additional button for sending money -->
                <a href="pay.html" class="btn btn-secondary btn-xl text-uppercase">Make Payment</a>
            </div>
        </form>
    </div>
</section>

<script>
$(function(){
	$('#contactForm').submit(function(e){
		e.preventDefault()
		$.ajax({
			url:_base_url_+"classes/Master.php?f=save_inquiry",
			method:"POST",
			data:$(this).serialize(),
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("an error occured",'error')
				end_loader()
			},
			success:function(resp){
				if(typeof resp == 'object' && resp.status == 'success'){
					alert_toast("Inquiry sent",'success')
					$('#contactForm').get(0).reset()
				}else{
					console.log(resp)
					alert_toast("an error occured",'error')
					end_loader()
				}
			}
		})
	})
})
</script>
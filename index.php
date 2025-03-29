<?php
include "layout/boilerplate.php"
?>
<section class="position-relative text-center text-white">
  <!-- Background Overlay to Improve Text Visibility -->
  <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-50"></div>

  <div class="container position-relative z-3">
    <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
      <div class="col-lg-8">
        <h1 class="display-4 fw-bold">
          Discover the Best Deals at <span class="text-warning">BrassBliss</span>
        </h1>
        <p class="lead mt-3">
          Shop the latest trends with amazing discounts. Limited-time offers just for you!
        </p>
        <a href="/shop" class="btn btn-warning btn-lg mt-4 px-5 shadow-sm">
          Start Shopping
        </a>
      </div>
    </div>
  </div>

  <!-- Background Image with Proper Positioning -->
  <div class="position-absolute top-0 start-0 w-100 h-100" 
       style="background: url('https://images.unsplash.com/photo-1441984904996-e0b6ba687e04?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D') 
              center/cover no-repeat; z-index: -1;">
  </div>
  <p class="mb-0">&copy; 2025 My_store. All Rights Reserved.</p>
</section>
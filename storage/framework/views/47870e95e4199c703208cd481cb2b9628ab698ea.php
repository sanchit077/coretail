<?php $__env->startSection('title', __('admin_dashboard.dashboard')); ?>
<?php $__env->startSection('content'); ?>
    <div class="main_tab">
                        <button class="tablinks active" onclick="openCity(event, 'Pending_Listings')">Pending Listings(10)</button>
                        <button class="tablinks" onclick="openCity(event, 'brand_owner')">Active Listings(450)</button>
                        <button class="tablinks" onclick="openCity(event, 'brand_owner')">Archived Listings(678)</button>
                        <div class="restore_button">
                            <a href="">+ Add New Listing</a>
                        </div>
                    </div>
                    <div id="Pending_Listings" class="tabcontent">
                        <div class="row">
                            <div class="Pending_Listings_outter">
                                <div class="form-group">
                                    <label>Location</label>
                                    <select>
                                        <option>Riyadh, Saudi Arabia</option>
                                    </select>
                                </div>
                            </div>
                            <div class="Pending_Listings_outter">
                                <div class="form-group">
                                    <label>Price</label>
                                    
                                </div>
                            </div>
                            <div class="Pending_Listings_outter">
                                <div class="form-group">
                                    <label>Duration</label>
                                    <input type="text" placeholder="Enter your duration">
                                </div>
                            </div>
                            <div class="Pending_Listings_outter">
                                <div class="form-group">
                                    <label>Space</label>
                                    <input type="text" placeholder="Enter your duration">
                                </div>
                            </div>
                            <div class="Pending_Listings_outter">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select>
                                        <option>All</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-6">
                                <div class="Pending_Listings_products">
                                    <img src="assets/main_images_for_login_sign_up.png">
                                    <h3>Entire Store</h3>
                                    <p>350 Sq M . London</p>
                                    <p>Avg sale <span>£231</span> per day</p>
                                    <p>Listed by <span>Ahmed Mohammed</span></p>
                                    <a href="#">View Details</a>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="Pending_Listings_products">
                                    <img src="assets/main_images_for_login_sign_up.png">
                                    <h3>Entire Store</h3>
                                    <p>350 Sq M . London</p>
                                    <p>Avg sale <span>£231</span> per day</p>
                                    <p>Listed by <span>Ahmed Mohammed</span></p>
                                    <a href="#">View Details</a>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="Pending_Listings_products">
                                    <img src="assets/main_images_for_login_sign_up.png">
                                    <h3>Entire Store</h3>
                                    <p>350 Sq M . London</p>
                                    <p>Avg sale <span>£231</span> per day</p>
                                    <p>Listed by <span>Ahmed Mohammed</span></p>
                                    <a href="#">View Details</a>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="Pending_Listings_products">
                                    <img src="assets/main_images_for_login_sign_up.png">
                                    <h3>Entire Store</h3>
                                    <p>350 Sq M . London</p>
                                    <p>Avg sale <span>£231</span> per day</p>
                                    <p>Listed by <span>Ahmed Mohammed</span></p>
                                    <a href="#">View Details</a>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="Pending_Listings_products">
                                    <img src="assets/main_images_for_login_sign_up.png">
                                    <h3>Entire Store</h3>
                                    <p>350 Sq M . London</p>
                                    <p>Avg sale <span>£231</span> per day</p>
                                    <p>Listed by <span>Ahmed Mohammed</span></p>
                                    <a href="#">View Details</a>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="Pending_Listings_products">
                                    <img src="assets/main_images_for_login_sign_up.png">
                                    <h3>Entire Store</h3>
                                    <p>350 Sq M . London</p>
                                    <p>Avg sale <span>£231</span> per day</p>
                                    <p>Listed by <span>Ahmed Mohammed</span></p>
                                    <a href="#">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.Admin.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/php-4/coretail/resources/views/Admin/dashboard/index.blade.php ENDPATH**/ ?>
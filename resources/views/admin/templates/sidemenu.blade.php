<!-- BEGIN: Left Aside -->
				<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
					<i class="la la-close"></i>
				</button>
				<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">
					<!-- BEGIN: Aside Menu -->
					<div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " data-menu-vertical="true" data-menu-scrollable="false" data-menu-dropdown-timeout="500" >
						<ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
							<li class="m-menu__item  m-menu__item--active" aria-haspopup="true" >
								<a onclick="call('<?= url('dashboard'); ?>','_content_','Admin User')" class="m-menu__link ">
									<i class="m-menu__link-icon flaticon-line-graph"></i>
									<span class="m-menu__link-title">
										<span class="m-menu__link-wrap">
											<span class="m-menu__link-text">
												Dashboard
											</span>
										</span>
									</span>
								</a>
							</li>
							<li class="m-menu__section">
								<h4 class="m-menu__section-text">
									Management
								</h4>
								<i class="m-menu__section-icon flaticon-more-v3"></i>
							</li>

							@if(Auth::user()->USER_ROLE_ID == 1 || Auth::user()->USER_ROLE_ID == 3)
							<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover">
								<a  href="#" class="m-menu__link m-menu__toggle">
									<i class="m-menu__link-icon flaticon-folder-2"></i>
									<span class="m-menu__link-text">
										POS
									</span>
									<i class="m-menu__ver-arrow la la-angle-right"></i>
								</a>
								<div class="m-menu__submenu">
									<span class="m-menu__arrow"></span>
									<ul class="m-menu__subnav">
										<li class="m-menu__item " aria-haspopup="true" >
											<a onclick="call('<?= url('management-pos/view'); ?>','_content_','POS (Point of Sales)')" class="m-menu__link m-menu__toggle">
												<i class="m-menu__link-bullet m-menu__link-bullet--dot">
													<span></span>
												</i>
												<span class="m-menu__link-text">
													New POS
												</span>
											</a>
										</li>
										<li class="m-menu__item " aria-haspopup="true" >
											<a onclick="call('<?= url('management-pos/list'); ?>','_content_','History POS')" class="m-menu__link ">
												<i class="m-menu__link-bullet m-menu__link-bullet--dot">
													<span></span>
												</i>
												<span class="m-menu__link-text">
													History POS
												</span>
											</a>
										</li>										
									</ul>
								</div>
							</li>

							@endif							

							@if(Auth::user()->USER_ROLE_ID != 2 && Auth::user()->USER_ROLE_ID != 21)
							<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover">
								<a  href="#" class="m-menu__link m-menu__toggle">
									<i class="m-menu__link-icon flaticon-users"></i>
									<span class="m-menu__link-text">
										Users
									</span>
									<i class="m-menu__ver-arrow la la-angle-right"></i>
								</a>
								<div class="m-menu__submenu">
									<span class="m-menu__arrow"></span>
									<ul class="m-menu__subnav">
										@if(Auth::user()->USER_ROLE_ID == 3)
										<li class="m-menu__item " aria-haspopup="true" >
											<a onclick="call('<?= url('management-user/list/admin'); ?>','_content_','Admin User')" class="m-menu__link m-menu__toggle">
												<i class="m-menu__link-bullet m-menu__link-bullet--dot">
													<span></span>
												</i>
												<span class="m-menu__link-text">
													Admin
												</span>
											</a>
										</li>
										<li class="m-menu__item " aria-haspopup="true" >
											<a  onclick="call('<?= url('management-user/list/manager'); ?>','_content_','Manager User')" class="m-menu__link ">
												<i class="m-menu__link-bullet m-menu__link-bullet--dot">
													<span></span>
												</i>
												<span class="m-menu__link-text">
													Manager
												</span>
											</a>
										</li>
										<li class="m-menu__item " aria-haspopup="true" >
											<a  onclick="call('<?= url('management-user/list/cashier'); ?>','_content_','Cashier User')" class="m-menu__link ">
												<i class="m-menu__link-bullet m-menu__link-bullet--dot">
													<span></span>
												</i>
												<span class="m-menu__link-text">
													Cashier
												</span>
											</a>
										</li>
										@else
										<li class="m-menu__item " aria-haspopup="true" >
											<a  onclick="call('<?= url('management-user/list/manager'); ?>','_content_','Manager User')" class="m-menu__link ">
												<i class="m-menu__link-bullet m-menu__link-bullet--dot">
													<span></span>
												</i>
												<span class="m-menu__link-text">
													Manager
												</span>
											</a>
										</li>
										<li class="m-menu__item " aria-haspopup="true" >
											<a  onclick="call('<?= url('management-user/list/cashier'); ?>','_content_','Cashier User')" class="m-menu__link ">
												<i class="m-menu__link-bullet m-menu__link-bullet--dot">
													<span></span>
												</i>
												<span class="m-menu__link-text">
													Cashier
												</span>
											</a>
										</li>
										@endif
									</ul>
								</div>
							</li>
							@endif

							@if(Auth::user()->USER_ROLE_ID != 2 && Auth::user()->USER_ROLE_ID != 21)
							<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover">
								<a onclick="call('<?= url('management-comprof/view'); ?>','_content_','Company Profile')" class="m-menu__link m-menu__toggle">
									<i class="m-menu__link-icon flaticon-map-location"></i>
									<span class="m-menu__link-text">
										Company Profile
									</span>									
								</a>								
							</li>							
							@endif

							@if(Auth::user()->USER_ROLE_ID != 2 && Auth::user()->USER_ROLE_ID != 21)
							<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover">
								<a  href="#" class="m-menu__link m-menu__toggle">
									<i class="m-menu__link-icon flaticon-folder-2"></i>
									<span class="m-menu__link-text">
										Master
									</span>
									<i class="m-menu__ver-arrow la la-angle-right"></i>
								</a>
								<div class="m-menu__submenu">
									<span class="m-menu__arrow"></span>
									<ul class="m-menu__subnav">
										<li class="m-menu__item " aria-haspopup="true" >
											<a onclick="call('<?= url('management-master/list/menu'); ?>','_content_','Menu Master')" class="m-menu__link m-menu__toggle">
												<i class="m-menu__link-bullet m-menu__link-bullet--dot">
													<span></span>
												</i>
												<span class="m-menu__link-text">
													Menu
												</span>
											</a>
										</li>
										<li class="m-menu__item " aria-haspopup="true" >
											<a  onclick="call('<?= url('management-master/list/kom'); ?>','_content_','Kind Of Menu')" class="m-menu__link ">
												<i class="m-menu__link-bullet m-menu__link-bullet--dot">
													<span></span>
												</i>
												<span class="m-menu__link-text">
													Kind Of Menu
												</span>
											</a>
										</li>
										<li class="m-menu__item " aria-haspopup="true" >
											<a  onclick="call('<?= url('management-master/list/table'); ?>','_content_','Master Table')" class="m-menu__link ">
												<i class="m-menu__link-bullet m-menu__link-bullet--dot">
													<span></span>
												</i>
												<span class="m-menu__link-text">
													Table
												</span>
											</a>
										</li>										
									</ul>
								</div>
							</li>
							@endif

							<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover">
								<a onclick="call('<?= url('management-report/list'); ?>','_content_','Report')" class="m-menu__link m-menu__toggle">
									<i class="m-menu__link-icon flaticon-open-box"></i>
									<span class="m-menu__link-text">
										Report
									</span>									
								</a>								
							</li>
							
						</ul>
					</div>
					<!-- END: Aside Menu -->
				</div>
				<!-- END: Left Aside -->
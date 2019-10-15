<div class="sidebar" data-color="purple" data-background-color="white" data-image="{{ asset('img/sidebar-1.jpg') }}">
       <!--
         Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"
 
         Tip 2: you can also add an image using data-image tag
     -->
       <div class="logo">
         <a href="http://www.creative-tim.com" class="simple-text logo-normal">
           {{Session::get('app_info')->nama_sekolah}} <br>
           <small><strong>NPSN: {{Session::get('app_info')->npsn}}</strong></small>
         </a>
       </div>
       <div class="sidebar-wrapper">
         <ul class="nav">
           <li class="nav-item">
             <a class="nav-link" href="/dashboard">
               <i class="material-icons">dashboard</i>
               <p>Dashboard</p>
             </a>
           </li>
            @if(Auth::user()->level == 'admin')
                <li class="nav-item">
                    <a href="/dashboard/users" class="nav-link">
                        <i class="material-icons">people</i>
                        <p>Pengguna</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/dashboard/siswas" class="nav-link">
                        <i class="material-icons">faces</i>
                        <p>Siswa</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/dashboard/rombels" class="nav-link">
                        <i class="material-icons">class</i>
                        <p>Rombel</p>
                    </a>
                </li>
                <li class="nav-item submenuToggle">
                    <a href="#" class="nav-link submenu-toggle" data-toggle="collapse" data-target="#settings-nav">
                      <i class="material-icons">tune</i>
                      <p>
                        Settings
                        <b class="caret"></b>
                      </p>
                    </a>
                    <div class="collapse" id="settings-nav">
                      <ul class="nav">
                        <li class="nav-item">
                          <a href="/dashboard/settings/data-sekolah" class="nav-link">
                            <i class="material-icons">home</i>  
                            Data Sekolah
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="/dashboard/settings/mapel" class="nav-link">
                            <i class="material-icons">menu_book</i>  
                            Mapel & Kompetensi
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="/dashboard/settings/tema" class="nav-link">
                            <i class="material-icons">chrome_reader_mode</i>  
                            Tema & Subtema
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="/dashboard/settings/tematik" class="nav-link">
                            <i class="material-icons">layers</i>  
                            Pemetaan Tema & KD
                          </a>
                        </li>
                      </ul>
                    </div>
                </li>
            @elseif(Auth::user()->level == 'guru')
                <li class="nav-item ">
                    <a class="nav-link" href="/dashboard/profil/{{Auth::user()->username}}">
                        <i class="material-icons">person</i>
                        <p>User Profile</p>
                    </a>
                </li>
                <li class="nav-item submenu-toggle">
                    <a class="nav-link" href="#" data-toggle="collapse" data-target="#settings-nav">
                        <i class="material-icons">ballot</i>
                        <p>
                            Penilaian
                            <b class="caret"></b>
                          </p>
                    </a>
                    <div class="collapse" id="settings-nav">
                      <ul class="nav">
                          <li class="nav-item">
                          <a href="/dashboard/penilaian/harian" class="nav-link">
                              <i class="material-icons">layers</i>  
                                Harian
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="/dashboard/penilaian/pts" class="nav-link">
                              <i class="material-icons">layers</i>  
                              PTS
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="/dashboard/penilaian/pas" class="nav-link">
                              <i class="material-icons">layers</i>  
                              PAS
                            </a>
                          </li>
                      </ul>
                    </div>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="/dashboard/ledger">
                        <i class="material-icons">developer_board</i>
                        <p>Ledger</p>
                    </a>
                </li>


                <li class="nav-item ">
                    <a class="nav-link" href="/dashboard/siswaku">
                        <i class="material-icons">emoji_people</i>
                        <p>Siswa</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="/dashboard/raport">
                        <i class="material-icons">file_copy</i>
                        <p>Raport</p>
                    </a>
                </li>
            @endif
           
           
           <li class="nav-item active-pro ">
             <a class="nav-link btn-logout" href="#" onclick="javascript:logout()">
               <i class="material-icons">power_settings_new</i>
               <p>Keluar</p>
             </a>
           </li>
         </ul>
       </div>
     </div>
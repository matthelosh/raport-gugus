<div class="sidebar" data-color="purple" data-background-color="white" data-image="{{ asset('img/sidebar-1.jpg') }}">
       <!--
         Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"
 
         Tip 2: you can also add an image using data-image tag
     -->
       <div class="logo">
         <a href="http://www.creative-tim.com" class="simple-text logo-normal">
           Creative Tim
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
                <li class="nav-item">
                    <a href="/dashboard/tingkat" class="nav-link">
                        <i class="material-icons">grade</i>
                        <p>Kelas/Tingkat</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/dashboard/settings" class="nav-link">
                        <i class="material-icons">settings</i>
                        <p>Pengaturan</p>
                    </a>
                </li>
            @elseif(Auth::user()->level == 'guru')
                <li class="nav-item ">
                    <a class="nav-link" href="./user.html">
                        <i class="material-icons">person</i>
                        <p>User Profile</p>
                    </a>
                </li>
            @endif
           
           
           <li class="nav-item active-pro ">
             <a class="nav-link" href="/logout">
               <i class="material-icons">power_settings_new</i>
               <p>Keluar</p>
             </a>
           </li>
         </ul>
       </div>
     </div>
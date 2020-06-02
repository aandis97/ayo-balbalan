<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
    
    <li class="{{ (Request::is('admin/dashboard') || Request::is('admin/')) ? 'active' : '' }}">
        <a href="{{ route('admin.index') }}">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          <span class="pull-right-container">
          </span>
        </a>
      </li>  
      <li  class="{{ (Request::is('admin/tim') || Request::is('admin/tim/*')) ? 'active' : '' }}"><a href="{{ route('tim.index') }}"><i class="fa fa-soccer-ball-o text-red"></i> <span>Data Master Tim</span></a></li>
      <li class="{{ (Request::is('admin/pemain') || Request::is('admin/pemain/*')) ? 'active' : '' }}"><a href="{{ route('pemain.index') }}"><i class="fa fa-users text-aqua"></i> <span>Data Master Pemain</span></a></li>
      <li class="header">Transaksi</li>
      <li  class="{{ (Request::is('admin/pertandingan') || Request::is('admin/pertandingan/*')) ? 'active' : '' }}"><a href="{{ route('pertandingan.index') }}"><i class="fa  fa-calendar"></i> <span>Jadwal Pertandingan</span>
        <!-- <span class="pull-right-container">
          <small class="label pull-right bg-green">16</small>
        </span> -->
      </a></li>
      <li  class="{{ (Request::is('admin/pertandingan-selesai') || Request::is('admin/pertandingan-selesai/*')) ? 'active' : '' }}"><a href="{{ route('pertandingan-selesai.index') }}"><i class="fa fa-calendar-check-o "></i> <span>Pertandingan Selesai</span></a>
        </li>

    </ul>
  </section>
  <!-- /.sidebar -->
</aside>

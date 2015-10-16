<table class="table table-hover">
    <tr>
       <td>Akses Halaman Admin</td>
       <td><input name="admin" value="1" type="checkbox"
             @if(!empty($admin))
                @if($admin->can('admin'))
                   {{ 'checked' }}
                @endif
             @endif
             /></td>
    </tr>
    <tr>
      <td>Akses Halaman Artikel</td>
      <td><input name="artikel" value="1" type="checkbox"
            @if(!empty($admin))
               @if($admin->can('artikel'))
                  {{ 'checked' }}
               @endif
            @endif
            /></td>
    <tr>
    <tr>
        <td>Akses Halaman CU Primer</td>
          <td><input name="cuprimer" value="1" type="checkbox"
                @if(!empty($admin))
                   @if($admin->can('cuprimer'))
                      {{ 'checked' }}
                   @endif
                @endif
                /></td>
    </tr>
    <tr>
        <td>Akses Halaman Info Gerakan</td>
          <td><input name="infogerakan" value="1" type="checkbox"
                @if(!empty($admin))
                   @if($admin->can('infogerakan'))
                      {{ 'checked' }}
                   @endif
                @endif
                /></td>
    </tr>
    <tr>
        <td>Akses Halaman Kantor Pelayanan</td>
          <td><input name="kantorpelayanan" value="1" type="checkbox"
                @if(!empty($admin))
                   @if($admin->can('kantorpelayanan'))
                      {{ 'checked' }}
                   @endif
                @endif
                /></td>
    </tr>
    <tr>
        <td>Akses Halaman Kategori Artikel</td>
          <td><input name="kategoriartikel" value="1" type="checkbox"
                @if(!empty($admin))
                   @if($admin->can('kategoriartikel'))
                      {{ 'checked' }}
                   @endif
                @endif
                /></td>
    </tr>
    <tr>
        <td>Akses Halaman Kegiatan</td>
          <td><input name="kegiatan" value="1" type="checkbox"
                @if(!empty($admin))
                   @if($admin->can('kegiatan'))
                      {{ 'checked' }}
                   @endif
                @endif
                /></td>
    </tr>
    <tr>
        <td>Akses Halaman Pelayanan</td>
          <td><input name="pelayanan" value="1" type="checkbox"
                @if(!empty($admin))
                   @if($admin->can('pelayanan'))
                      {{ 'checked' }}
                   @endif
                @endif
                /></td>
    </tr>
    <tr>
        <td>Akses Halaman Pengumuman</td>
          <td><input name="pengumuman" value="1" type="checkbox"
                @if(!empty($admin))
                   @if($admin->can('pengumuman'))
                      {{ 'checked' }}
                   @endif
                @endif
                /></td>
    </tr>
    <tr>
        <td>Akses Halaman Staff</td>
          <td><input name="staff" value="1" type="checkbox"
                @if(!empty($admin))
                   @if($admin->can('staff'))
                      {{ 'checked' }}
                   @endif
                @endif
                /></td>
    </tr>
    <tr>
        <td>Akses Halaman Wilayah Cu Primer</td>
        <td><input name="wilayahcuprimer" value="1" type="checkbox"
            @if(!empty($admin))
                @if($admin->can('wilayahcuprimer'))
                    {{ 'checked' }}
                        @endif
                    @endif
                    /></td>
    </tr>
    <tr>
        <td>Akses Halaman Download</td>
        <td><input name="download" value="1" type="checkbox"
            @if(!empty($admin))
                @if($admin->can('download'))
                    {{ 'checked' }}
                        @endif
                    @endif
                    /></td>
    </tr>
    <tr>
        <td>Akses Halaman Saran atau Kritik</td>
        <td><input name="saran" value="1" type="checkbox"
            @if(!empty($admin))
                @if($admin->can('saran'))
                    {{ 'checked' }}
                        @endif
                    @endif
            /></td>
    </tr>
</table>
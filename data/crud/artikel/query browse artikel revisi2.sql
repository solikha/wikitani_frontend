select row_number() OVER () as rnum, c.nama_kategori,d.subkategori_nama,b.judul_artikel,b.artikel_id,
string_agg('<i class="fa fa-file-text-o"></i><span style="color:blue; margin-left:5px;"><a style="color:blue;" href="artikel?artikel_id="'a.artikel_konten_id'">'||a.judul_konten_artikel||'</a></span>','<br/>') as judul_konten
from app_artikelkonten a 
left join app_artikel b on a.artikel_id = b.artikel_id 
left join app_kategori c on b.kategori_id= c.kategori_id
left join app_subkategori d on b.subkategori_id= d.subkategori_id
group by a.artikel_id,c.nama_kategori,d.subkategori_nama,b.artikel_id,b.judul_artikel
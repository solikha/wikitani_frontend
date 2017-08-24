select row_number() OVER () as rnum, c.nama_kategori,d.subkategori_nama,
string_agg(a.judul_konten_artikel,'<br/>') as judul_konten
from app_artikelkonten a 
left join app_artikel b on a.artikel_id = b.artikel_id 
left join app_kategori c on b.kategori_id= c.kategori_id
left join app_subkategori d on b.subkategori_id= d.subkategori_id
group by a.artikel_id,c.nama_kategori,d.subkategori_nama
select c.nama_kategori,string_agg(a.judul_konten_artikel,'=>') 
from app_artikelkonten a 
left join app_artikel b on a.artikel_id = b.artikel_id
left join app_kategori c on b.kategori_id= c.kategori_id
group by a.artikel_id,c.nama_kategori;

-- select a.judul_konten_artikel 
-- from 
-- app_artikelkonten a 
-- group by a.artikel_konten_id;
select :isdebug as isdebug, case when a.taskname in ('permohonan') then 1 else 0 end as canedit, 
  a.layananidhash as lyn_id, 
  a.id, a.wniid, a.id as wni_lyn_id, 
  a.regid, a.layananid, a.sublayananid, a.statusname, 
  case when h.id is not null then h.nama_lengkap else f.fullname end as pemohon, 
  e.taskname, 
  to_char(a.createtime, 'dd-mm-yyyy hh:mm') as create_time, 
  b.nama as nama_layanan, c.nama as nama_sublayanan, 
  d.description as status_description,
  e.description as task_description,
  e.public_instruction as task_instruction,
  e.public_actionby as task_actionby,
  g.taskname as g_taskname, k.biaya, i.nama as jenkel, 
  j.nama as statuskawin, h.email 
from wni_layanan a 
left join layanan b on a.layananid = b.id
left join app_status_layanan g on b.id=g.layananid and g.kode=a.layananid
left join layanan_sub c on a.sublayananid = c.id
left join app_status d on a.statusname = d.statusname 
left join app_task e on a.taskname = e.taskname and a.layananid = e.layananid 
left join sys_users f on a.username = f.username 
left join wni h on a.wniid = h.id
left join jenis_kelamin i on i.id=h.jenkelid
left join status_kawin j on j.id=h.statuskawinid
left join (
  select max(biaya) as biaya, layananid 
  from layanan_sub 
  where layananid =layananid group by layananid limit 1  )k on k.layananid=a.layananid
where a.statusname in ('start', 'proses') 
and (:textsearch is null
  or b.nama ilike '%' || :textsearch || '%'   or c.nama ilike '%' || :textsearch || '%'   
  or case when h.id is not null then h.nama_lengkap else f.fullname end ilike '%' || :textsearch || '%' 
  or e.description ilike '%' || :textsearch || '%' )
order by a.id desc limit :pagerec offset (:pagerec * (:pagenum-1))
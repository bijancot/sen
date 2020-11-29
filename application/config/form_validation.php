<?php
$config = array('pendaftaran' => 
					[
            ['field' => 'namatim',
            'label' => 'Nama Tim',
            'rules' => 'required|is_unique[peserta.namatim]',
						'errors' => ['required' => '%s harus diisi.',
						 'is_unique' => '%s sudah ada, silahkan ganti']],

            ['field' => 'email',
            'label' => 'Email',
            'rules' => 'required|valid_email|is_unique[peserta.email]',
						'errors' => ['required' => '%s harus diisi.',
            'valid_email' => '%s harus diisi dengan benar.',
            'is_unique' => '%s sudah ada, silahkan ganti']],
						
						['field' => 'password',
            'label' => 'Password',
            'rules' => 'required|min_length[6]',
						'errors' => ['required' => '%s harus diisi.',
						'min_length' => 'Panjang %s minimal adalah 6 karakter.']],
            
            ['field' => 'nohp',
            'label' => 'No Handphone',
            'rules' => 'required',
						'errors' => ['required' => '%s harus diisi.']],

            ['field' => 'idpt',
            'label' => 'Perguruan Tinggi',
            'rules' => 'required|callback_cek_dropdown',
            'errors' => ['required' => '%s harus diisi.']],

            ['field' => 'idlomba',
            'label' => 'Kategori Lomba',
            'rules' => 'required|callback_cek_dropdown',
						'errors' => ['required' => '%s harus diisi.']]
        ],
				'kategori1' => 
					[	
            ['field' => 'teaser',
            'label' => 'Video Teaser',
            'rules' => 'required'],

            ['field' => 'pernyataan',
            'label' => 'Surat Pernyataan',
            'rules' => 'callback_cek_upload_pernyataan'],            

            ['field' => 'karya',
            'label' => 'Proposal',
            'rules' => 'callback_cek_upload_proposal'],
            
        ],

        'kategori2' => 
					[	
            ['field' => 'teaser',
            'label' => 'Video Teaser',
            'rules' => 'required'],

            ['field' => 'pernyataan',
            'label' => 'Surat Pernyataan',
            'rules' => 'callback_cek_upload_pernyataan'],            

            ['field' => 'karya',
            'label' => 'Poster',
            'rules' => 'callback_cek_upload_poster'],
        ],

        'kategori3' => 
					[	
            ['field' => 'teaser',
            'label' => 'Video Teaser',
            'rules' => 'required'],

            ['field' => 'pernyataan',
            'label' => 'Surat Pernyataan',
            'rules' => 'callback_cek_upload_pernyataan'],            

            ['field' => 'karya',
            'label' => 'Proposal',
            'rules' => 'callback_cek_upload_proposal'],
            
        ],

        'kategori4' => 
					[	
            ['field' => 'teaser',
            'label' => 'Video Teaser',
            'rules' => 'required'],

            ['field' => 'pernyataan',
            'label' => 'Surat Pernyataan',
            'rules' => 'callback_cek_upload_pernyataan'],            

            ['field' => 'karya',
            'label' => 'Proposal',
            'rules' => 'callback_cek_upload_proposal1'],

            ['field' => 'karya2',
            'label' => 'Karya Desain',
            'rules' => 'callback_cek_upload_karya2'],
            
        ],

        'kategori5' => 
        [	
          ['field' => 'teaser',
          'label' => 'Video Teaser',
          'rules' => 'required'],

          ['field' => 'pernyataan',
          'label' => 'Surat Pernyataan',
          'rules' => 'callback_cek_upload_pernyataan'],            

          ['field' => 'youtube',
          'label' => 'Link Youtube',
          'rules' => 'required'],

          ['field' => 'karya',
          'label' => 'File Video',
          'rules' => 'callback_cek_upload_video'],
          
      ],

        'bukti' => 
					[					                        
            ['field' => 'nohp',
            'label' => 'Valid',
            'rules' => 'required'],
            ['field' => 'bukti',
            'label' => 'File Bukti Bayar',
            'rules' => 'callback_cek_upload_bukti'],
            
        ],
        'valid' => 
					[					                        
            ['field' => 'valid',
            'label' => 'Valid',
            'rules' => 'required'],
            
        ],
				'anggota' => 
					[
            ['field' => 'namaketua',
            'label' => 'Nama Ketua',
            'rules' => 'required',
						'errors' => ['required' => '%s harus diisi.']],
						
						['field' => 'anggota2',
            'label' => 'Nama Anggota 2',
            'rules' => 'required',
						'errors' => ['required' => '%s harus diisi.']],

            ['field' => 'email2',
            'label' => 'Email Anggota 2',
            'rules' => 'required|valid_email',
						'errors' => ['required' => '%s harus diisi.',
						'valid_email' => '%s harus diisi dengan benar.']],

            ['field' => 'nohp2',
            'label' => 'No HP Anggota 2',
            'rules' => 'required',
						'errors' => ['required' => '%s harus diisi.']],
						
						['field' => 'anggota3',
            'label' => 'Nama Anggota 3',
            'rules' => 'required',
						'errors' => ['required' => '%s harus diisi.']],

            ['field' => 'email3',
            'label' => 'Email Anggota 3',
            'rules' => 'required|valid_email',
						'errors' => ['required' => '%s harus diisi.',
						'valid_email' => '%s harus diisi dengan benar.']],

            ['field' => 'nohp3',
            'label' => 'No HP Anggota 3',
            'rules' => 'required',
						'errors' => ['required' => '%s harus diisi.']],
						
						['field' => 'nidn',
            'label' => 'NIDN Pembimbing',
            'rules' => 'required',
						'errors' => ['required' => '%s harus diisi.']],

            ['field' => 'pembimbing',
            'label' => 'Nama Dosen Pembimbing',
            'rules' => 'required',
						'errors' => ['required' => '%s harus diisi.']],

            ['field' => 'ktm',
            'label' => 'Dokumen KTM',
            'rules' => 'callback_cek_upload_ktm'],
          ],  
        
				'login' => 
				[
						['field' => 'email',
            'label' => 'Email',
            'rules' => 'required|valid_email',
						'errors' => ['required' => '%s harus diisi.',
						'valid_email' => '%s harus diisi dengan benar.']],
						
						['field' => 'password',
            'label' => 'Password',
            'rules' => 'required|callback_cek_password',
						'errors' => ['required' => '%s harus diisi.',
						'min_length' => 'Panjang %s minimal adalah 6 karakter.']]
				]
);
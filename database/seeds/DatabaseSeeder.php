<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$current_timestamp = date('Y-m-d h:i:s');


		DB::table('modules')->insert(
			[
				[
            'name' => 'Dashboard',
			    	'father_path' => '',
			    	'path' => 'cms/dashboard',
            'route' => 'dashboard',
			    	'order' => 0,
			    	'icon' => 'fa fa-dashboard',
			    	'has_son' => 0,
			    	'created_at' => $current_timestamp,
			    	'updated_at' => $current_timestamp,
			    	'father_order' => 0
		        ],
				[
					'name' => 'Administração',
					'father_path' => '',
					'path' => 'cms/admin',
          'route' => 'admin',
					'order' => 10,
					'icon' => 'fa fa-lock',
					'has_son' => 1,
					'created_at' => $current_timestamp,
					'updated_at' => $current_timestamp,
					'father_order' => 2
				],
				[
					'name' => 'Grupos de Usuários',
					'father_path' => 'admin',
					'path' => 'groups',
          'route' => 'groups',
					'order' => 1,
					'icon' => '',
					'has_son' => 0,
					'created_at' => $current_timestamp,
					'updated_at' => $current_timestamp,
					'father_order' => 2
				],
				[
					'name' => 'Usuários',
					'father_path' => 'admin',
					'path' => 'users',
          'route' => 'users',
					'order' => 2,
					'icon' => '',
					'has_son' => 0,
					'created_at' => $current_timestamp,
					'updated_at' => $current_timestamp,
					'father_order' => 2
				],
        [
					'name' => 'Páginas',
					'father_path' => '',
					'path' => 'cms/pages',
          'route' => 'pages',
					'order' => 8,
					'icon' => 'fa fa-file-text-o',
					'has_son' => 0,
					'created_at' => $current_timestamp,
					'updated_at' => $current_timestamp,
					'father_order' => 0
				],
        [
					'name' => 'Configurações',
					'father_path' => '',
					'path' => 'cms/configs',
          'route' => 'configs',
					'order' => 9,
					'icon' => 'fa fa-wrench',
					'has_son' => 0,
					'created_at' => $current_timestamp,
					'updated_at' => $current_timestamp,
					'father_order' => 0
				],
        [
					'name' => 'Depoimentos',
					'father_path' => '',
					'path' => 'cms/depoimentos',
          'route' => 'depoimentos',
					'order' => 7,
					'icon' => 'fa fa-commenting-o',
					'has_son' => 0,
					'created_at' => $current_timestamp,
					'updated_at' => $current_timestamp,
					'father_order' => 0
				],
        [
					'name' => 'Corretores',
					'father_path' => '',
					'path' => 'cms/corretores',
          'route' => 'corretores',
					'order' => 6,
					'icon' => 'fa fa-users',
					'has_son' => 0,
					'created_at' => $current_timestamp,
					'updated_at' => $current_timestamp,
					'father_order' => 0
				],
        [
					'name' => 'Blogs',
					'father_path' => '',
					'path' => 'cms/blogs',
          'route' => 'blogs',
					'order' => 5,
					'icon' => 'fa fa-newspaper-o',
					'has_son' => 0,
					'created_at' => $current_timestamp,
					'updated_at' => $current_timestamp,
					'father_order' => 0
				],
        [
					'name' => 'Slides',
					'father_path' => '',
					'path' => 'cms/slides',
          'route' => 'slides',
					'order' => 3,
					'icon' => 'fa fa-picture-o',
					'has_son' => 0,
					'created_at' => $current_timestamp,
					'updated_at' => $current_timestamp,
					'father_order' => 0
				],
        [
					'name' => 'Publicidades',
					'father_path' => '',
					'path' => 'cms/publicidades',
          'route' => 'publicidades',
					'order' => 4,
					'icon' => 'fa fa-file-image-o',
					'has_son' => 0,
					'created_at' => $current_timestamp,
					'updated_at' => $current_timestamp,
					'father_order' => 0
				]
			]
	    );


		DB::table('groups')->insert([
            'name' => 'Administrador',
            'created_at' => $current_timestamp,
            'updated_at' => $current_timestamp
        ]);

		DB::table('group_module')->insert(
			[
    		['group_id' => '1','module_id' => '2','created_at' => NULL,'updated_at' => NULL],
				['group_id' => '1','module_id' => '4','created_at' => NULL,'updated_at' => NULL],
				['group_id' => '1','module_id' => '3','created_at' => NULL,'updated_at' => NULL],
				['group_id' => '1','module_id' => '1','created_at' => NULL,'updated_at' => NULL],
        ['group_id' => '1','module_id' => '5','created_at' => NULL,'updated_at' => NULL],
				['group_id' => '1','module_id' => '6','created_at' => NULL,'updated_at' => NULL],
				['group_id' => '1','module_id' => '7','created_at' => NULL,'updated_at' => NULL],
				['group_id' => '1','module_id' => '8','created_at' => NULL,'updated_at' => NULL],
        ['group_id' => '1','module_id' => '6','created_at' => NULL,'updated_at' => NULL],
				['group_id' => '1','module_id' => '10','created_at' => NULL,'updated_at' => NULL],
				['group_id' => '1','module_id' => '11','created_at' => NULL,'updated_at' => NULL]
    	]
  	);

      DB::table('users')->insert([
          'name' => 'Administrador',
        'email' => 'youremail@mail.com',
        'password' => '$2y$10$SrUcb3A7qLw4oSPDhpQfQeg4D7ILQYwtmtjA8pITz8ETgJI9wQf0y',
        'remember_token' => 'WFZ3NMP2AoMuNFMvtxioVSmYoyZHPmlL3W8aXomkJ68FHGDtED3XRi03Ry0R',
        'created_at' => '2018-02-13 11:28:36',
        'updated_at' => '2018-02-19 13:59:28',
        'username' => 'admin',
        'group_id' => 1
      ]);

      DB::table('pages')->insert(
  			[
      		[
            'id' => '1',
            'name' => 'Home - Encontramos o imóvel perfeito para você',
            'title' => NULL,
            'description' => '<p><strong>Sem tempo para pesquisar o imóvel desejado?</strong></p><p>Fique tranquilo, deixe seu nome, e-mail e WhatsApp no formulário a baixo, que entraremos em contato.</p>',
            'image' => NULL,
            'created_at' => $current_timestamp,
            'updated_at' => $current_timestamp
          ],
  				[
            'id' => '2',
            'name' => 'Home - Descrição acima de Depoimentos',
            'title' => 'IMASUL, 40 anos de especialidade em realizar o sonho do imóvel próprio',
            'description' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>',
            'image' => NULL,
            'created_at' => $current_timestamp,
            'updated_at' => $current_timestamp
          ],
  				[
            'id' => '3',
            'name' => 'Avaliação - Descrição',
            'title' => NULL,
            'description' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>',
            'image' => NULL,
            'created_at' => $current_timestamp,
            'updated_at' => $current_timestamp
          ],
  				[
            'id' => '4',
            'name' => 'Sobre - Descrição',
            'title' => 'IMASUL, 40 anos de especialidade em realizar o sonho do imóvel próprio',
            'description' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><p>Lorem ipsum dimagemet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><p><br></p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
            'created_at' => $current_timestamp,
            'created_at' => $current_timestamp,
            'updated_at' => $current_timestamp
          ],
          [
            'id' => '5',
            'name' => 'Sobre - Missão',
            'title' => NULL,
            'description' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>',
            'image' => NULL,
            'created_at' => $current_timestamp,
            'updated_at' => $current_timestamp
          ],
  				[
            'id' => '6',
            'name' => 'Sobre - Visão',
            'title' => NULL,
            'description' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>',
            'image' => NULL,
            'created_at' => $current_timestamp,
            'updated_at' => $current_timestamp
          ],
  				[
            'id' => '7',
            'name' => 'Sobre - Valores',
            'title' => NULL,
            'description' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>',
            'image' => NULL,
            'created_at' => $current_timestamp,
            'updated_at' => $current_timestamp
          ],
          [
            'id' => '8',
            'name' => 'Blog - Descrição',
            'title' => NULL,
            'description' => '<p>No blog da IMASUL, você sempre encontrará novidades sobre tudo que move o mundo imobiliário e da construção civil. Fique ligado.</p>',
            'image' => NULL,
            'created_at' => $current_timestamp,
            'updated_at' => $current_timestamp
          ],
  				[
            'id' => '9',
            'name' => 'Contato - Descrição',
            'title' => NULL,
            'description' => '<p>Envie-nos uma mensagem através do formulário a baixo, que em breve nosso time de corretores entrará em contato.</p>',
            'image' => NULL,
            'created_at' => $current_timestamp,
            'updated_at' => $current_timestamp
          ],
      	]
    	);
      DB::table('configs')->insert(
  			[
      		[
            'id' => '1',
            'keywords' => 'IMASUL,imsaul,imobiliaria,imobiliária,imóveis, concórdia, imoveis,alugar,vender,comprar,casas a venda, casas para alugar',
            'description' => 'IMASUL - Imobiliária',
            'facebook' => 'https://www.facebook.com/imasulimobiliaria/',
            'linkedin' => NULL,
            'instagram' => NULL,
            'endereco' => 'R. Osvaldo Valentim Zandavalli, 360 - Centro, Concórdia - SC, 89700-136',
            'link_mapa' => 'https://bit.ly/2sCiR9p',
            'telefone' => '(49) 3442-2015',
            'telefone_2' => '(49) 99999-9999',
            'telefone_3' => '(49) 99999-9999',
            'email' => 'contato@imasul.com.br',
            'created_at' => $current_timestamp,
            'updated_at' => $current_timestamp
          ]
      	]
    	);
    }
}

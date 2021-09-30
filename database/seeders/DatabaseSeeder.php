<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Type;
use App\Models\Status;
use App\Models\Service;
use App\Models\service_order;
use App\Models\Attend;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // \App\Models\service_order::factory(10)->create();

        User::create([
            'id' => 1,
            'name' => 'Junior Gucciardo',
            'email' => 'juniorgucciardo1@gmail.com',
            'password' => Hash::make('juniorjunior')
        ]);

        User::create([
            'id' => 2,
            'name' => 'Prestador de serviços',
            'email' => 'prestador@telereparos.com.br',
            'password' => Hash::make('prestador123')
        ]);

        $role = Role::create(['name' => 'administrator']);

        Permission::create([
            'name' => 'view_service_demands'
        ]);

        $role->givePermissionTo('view_service_demands');

        $user = User::find(1);
        $user->assignRole('administrator');

        Status::create([
            'id' => 1,
            'status_title' => 'Solicitacao realizada'
        ]);

        Status::create([
            'id' => 2,
            'status_title' => 'Agendado'
        ]);

        Status::create([
            'id' => 3,
            'status_title' => 'Em execução'
        ]);

        Status::create([
            'id' => 4,
            'status_title' => 'Concluido'
        ]);

        Type::create([
            'id' => 1,
            'type_title' => 'Servico Avulso'
        ]);

        Type::create([
            'id' => 2,
            'type_title' => 'Contrato'
        ]);

        Type::create([
            'id' => 3,
            'type_title' => 'Pos obra'
        ]);

        Type::create([
            'id' => 4,
            'type_title' => 'Seguradora'
        ]);

        Service::create([
            'id' => 1,
            'service_title' => 'Jardinagem',
            'service_description' => 'lorem ipsun dolor si amet'
        ]);
        Service::create([
            'id' => 2,
            'service_title' => 'Reparo eletrico/hidraulico',
            'service_description' => 'lorem ipsun dolor si amet'
        ]);
        Service::create([
            'id' => 3,
            'service_title' => 'Limpeza Residencial',
            'service_description' => 'lorem ipsun dolor si amet'
        ]);
        Service::create([
            'id' => 4,
            'service_title' => 'Limpeza Empresarial',
            'service_description' => 'lorem ipsun dolor si amet'
        ]);
        Service::create([
            'id' => 5,
            'service_title' => 'Limpeza Pós Obra',
            'service_description' => 'lorem ipsun dolor si amet'
        ]);
        Service::create([
            'id' => 6,
            'service_title' => 'Limpeza de placa solar',
            'service_description' => 'lorem ipsun dolor si amet'
        ]);

        Service::create([
            'id' => 7,
            'service_title' => 'Pintura',
            'service_description' => 'lorem ipsun dolor si amet'
        ]);

        Service::create([
            'id' => 8,
            'service_title' => 'Roçada de terreno',
            'service_description' => 'lorem ipsun dolor si amet'
        ]);





        //experimental



        service_order::create([
            'id' => 1,
            'nome_cliente' => 'José Gilberto Junior',
            'rua_cliente' => 'David Canabarro',
            'numero_cliente' => '369',
            'bairro_cliente' => 'Centro',
            'cidade_cliente' => 'Santo Ângelo',
            'contato_cliente' => '55 999190832',
            'descricao_servico' => 'roçada de terreno grande frente e tras de casa',
            'id_service' => 1,
            'data_ordem' => '21-09-30',
            'hora_ordem' => '11:40',
            'status_id' => 2,
            'type_id' => 1,
            'is_recurrent' => false,
            'recurrence' => 0,
            'amount' => 1
        ]);
        
        
        $hj = '2021-09-28';
        $hours = 2;
        $d1 = date('Y-m-d H:i:s', strtotime($hj.'13:30:00'));
        $d2 = date('Y-m-d H:i:s', strtotime($d1.'+2 hours'));

        for ($i=0; $i < 4; $i++) { 
            $a = Attend::create([
                'order_id' => 1,
                'data_inicial' => $d1,
                'data_final' => $d2
            ]);
            
            $d1 = date('Y-m-d H:i:s', strtotime('+3 days'. $d1));
            $a->users()->attach(1);
        }


        service_order::create([
            'id' => 2,
            'nome_cliente' => 'jane Netz',
            'rua_cliente' => 'David Canabarro',
            'numero_cliente' => '369',
            'bairro_cliente' => 'Centro',
            'cidade_cliente' => 'Santo Ângelo',
            'contato_cliente' => '55 999190832',
            'descricao_servico' => 'limpeza residencial',
            'id_service' => 3,
            'data_ordem' => '21-10-01',
            'hora_ordem' => '11:40',
            'status_id' => 2,
            'type_id' => 1,
            'is_recurrent' => true,
            'recurrence' => 15,
            'amount' => 6
        ]);

        $hj = '2021-09-28';
        $hours = 4;
        $d1 = date('Y-m-d H:i:s', strtotime($hj.'08:00:00'));
        $d2 = date('Y-m-d H:i:s', strtotime($d1.'+8 hours'));

        for ($i=0; $i < 8; $i++) { 
            $a = Attend::create([
                'order_id' => 2,
                'data_inicial' => $d1,
                'data_final' => $d2
            ]);
            
            $d1 = date('Y-m-d H:i:s', strtotime('+2 days'. $d1));
            $a->users()->attach(1);
        }
        
        



        
        service_order::create([
            'id' => 3,
            'nome_cliente' => 'Gilberto Ferreira da Silva',
            'rua_cliente' => 'David Canabarro',
            'numero_cliente' => '369',
            'bairro_cliente' => 'Centro',
            'cidade_cliente' => 'Santo Ângelo',
            'contato_cliente' => '55 999190832',
            'descricao_servico' => 'limpeza do escritório, vidros e calçadas',
            'id_service' => 4,
            'data_ordem' => '21-09-28',
            'hora_ordem' => '11:40',
            'status_id' => 2,
            'type_id' => 1,
            'is_recurrent' => true,
            'recurrence' => 15,
            'amount' => 6
        ]);


        $hj = '2021-09-28';
        $hours = 4;
        $d1 = date('Y-m-d H:i:s', strtotime($hj.'08:00:00'));
        $d2 = date('Y-m-d H:i:s', strtotime($d1.'+4 hours'));

        for ($i=0; $i < 12; $i++) { 
            $a = Attend::create([
                'order_id' => 3,
                'data_inicial' => $d1,
                'data_final' => $d2
            ]);
            
            $d1 = date('Y-m-d H:i:s', strtotime('+1 days'. $d1));
            $a->users()->attach(1);
        }

        service_order::create([
            'id' => 4,
            'nome_cliente' => 'Paulo Ferraza',
            'rua_cliente' => 'David Canabarro',
            'numero_cliente' => '369',
            'bairro_cliente' => 'Centro',
            'cidade_cliente' => 'Santo Ângelo',
            'contato_cliente' => '55 999190832',
            'descricao_servico' => 'limpeza do escritório, vidros e calçadas',
            'id_service' => 2,
            'data_ordem' => '21-09-28',
            'hora_ordem' => '11:40',
            'status_id' => 2,
            'type_id' => 2,
            'is_recurrent' => true,
            'recurrence' => 15,
            'amount' => 6
        ]);


        $hj = '2021-09-15';
        $hours = 4;
        $d1 = date('Y-m-d H:i:s', strtotime($hj.'08:00:00'));
        $d2 = date('Y-m-d H:i:s', strtotime($d1.'+2 hours'));

        for ($i=0; $i < 15; $i++) { 
            $a = Attend::create([
                'order_id' => 4,
                'data_inicial' => $d1,
                'data_final' => $d2
            ]);
            
            $d1 = date('Y-m-d H:i:s', strtotime('+3 days'. $d1));
            $a->users()->attach([1,2]);
        }

        
        
        
        

        

        


    }
}

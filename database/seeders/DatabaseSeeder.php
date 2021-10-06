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

        $this->createDemands();


    }

    public function createDemands(){
        $demand = service_order::create([
            'id' => 1,
            'nome_cliente' => 'José Gilberto Junior',
            'rua_cliente' => 'David Canabarro',
            'numero_cliente' => '369',
            'bairro_cliente' => 'Centro',
            'cidade_cliente' => 'Santo Ângelo',
            'contato_cliente' => '55 999190832',
            'descricao_servico' => 'roçada de terreno grande frente e tras de casa',
            'id_service' => 1,
            'data_ordem' => '2021-09-30',
            'hora_ordem' => '10:00',
            'type_id' => 1,
            'recurrence' => 0,
            'amount' => 1
        ]);
        
        
        $hj = $demand->data_ordem;
        $inicial_hour = $demand->hora_ordem;
        $final_hour = date('H:i:s', strtotime($inicial_hour.'+4 hours'));

        for ($i=0; $i < 10; $i++) { 
            $a = Attend::create([
                'order_id' => 1,
                'data_inicial' => date('Y-m-d H:i:s', strtotime($hj.$inicial_hour)),
                'data_final' => date('Y-m-d H:i:s', strtotime($hj.$final_hour))
            ]);
            
            $hj = date('Y-m-d', strtotime('+1 days'. $hj));
            $a->users()->attach([1,2]);
        }
    }

}

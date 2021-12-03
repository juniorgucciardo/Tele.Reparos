<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Type;
use App\Models\Situation;
use App\Models\Status;
use App\Models\ChecklistType;
use App\Models\Checklist;
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

        Permission::create([
            'name' => 'manage-blog'
        ]);

        $role->givePermissionTo('view_service_demands');
        $role->givePermissionTo('manage-blog');

        $user = User::find(1);
        $user->assignRole('administrator');

        Status::create([
            'id' => 1,
            'status_title' => 'Solicitado'
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

        Status::create([
            'id' => 5,
            'status_title' => 'atrasado'
        ]);

        Status::create([
            'id' => 6,
            'status_title' => 'cancelado'
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

        Type::create([
            'id' => 5,
            'type_title' => 'Condomínio'
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
            'service_title' => 'Limpeza de piscina',
            'service_description' => 'lorem ipsun dolor si amet'
        ]);

        Service::create([
            'id' => 6,
            'service_title' => 'Limpeza Pós Obra',
            'service_description' => 'lorem ipsun dolor si amet'
        ]);


        Service::create([
            'id' => 7,
            'service_title' => 'Limpeza de placa solar',
            'service_description' => 'lorem ipsun dolor si amet'
        ]);

        Service::create([
            'id' => 8,
            'service_title' => 'Pintura',
            'service_description' => 'lorem ipsun dolor si amet'
        ]);

        Service::create([
            'id' => 9,
            'service_title' => 'Roçada de terreno',
            'service_description' => 'lorem ipsun dolor si amet'
        ]);

        Service::create([
            'id' => 10,
            'service_title' => 'Limpeza de vidros e calçadas',
            'service_description' => 'lorem ipsun dolor si amet'
        ]);

        Service::create([
            'id' => 11,
            'service_title' => 'Limpeza de caixa de água',
            'service_description' => 'lorem ipsun dolor si amet'
        ]);


        

        Situation::create([
            'id' => 1,
            'title' => 'Solicitado',
            'description' => 'Serviço solicitado pelo cliente'
        ]);

        Situation::create([
            'id' => 2,
            'title' => 'Visita tecnica',
            'description' => 'a demanda vai ser analizada por um dos nossos supervisores'
        ]);

        Situation::create([
            'id' => 3,
            'title' => 'Confirmado',
            'description' => 'Serviço solicitado pelo cliente'
        ]);

        Situation::create([
            'id' => 4,
            'title' => 'Cancelado',
            'description' => 'Serviço solicitado pelo cliente'
        ]);

        ChecklistType::create([
            'id' => 1,
            'title' => 'Atividades',
        ]);

        ChecklistType::create([
            'id' => 2,
            'title' => 'Produtos e equipamentos',
        ]);

        ChecklistType::create([
            'id' => 3,
            'title' => 'Equipamentos de proteção',
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
            'recurrence_type' => 'daily',
            'months' => 1,
            'situation_id' => 3
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

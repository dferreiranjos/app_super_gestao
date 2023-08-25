<?php

namespace Database\Seeders;

use App\Models\MotivoContato;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MotivoContatoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // A sugestão foi essa, mas prefiro o método abaixo
        /*MotivoContato::create(['motivo_contato'=>'Dúvida']);
        MotivoContato::create(['motivo_contato'=>'Elogio']);
        MotivoContato::create(['motivo_contato'=>'Reclamação']);*/

        $motivos = ['Dúvida', 'Elogio', 'Reclamação'];

        $motivoContato = new MotivoContato();
        
        foreach($motivos as $motivo){

            $motivoContato->insert([
                'motivo_contato'=>$motivo,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\SiteContato;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteContatoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    // OBS: como já executei a seeder FornecedorSeeder e não quero que ele seja executada novamente, então vou usar a instrução seguinte: php artisan db:seed --class=SiteContatoSeeder
    public function run(): void
    {
        /*$contato = new SiteContato();
        $contato->nome = 'Sistema SG';
        $contato->telefone = '(31) 9999-9999';
        $contato->email = 'contato@sg.com.br';
        $contato->motivo_contato = 1;
        $contato->mensagem = 'Seja bem vindo ao sistema super gestão';
        $contato->save();*/

        SiteContato::factory(100)->create();

    }
}

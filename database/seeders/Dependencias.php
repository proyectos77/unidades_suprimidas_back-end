<?php

namespace Database\Seeders;

use App\Models\Denpendencias\Dependencias as DenpendenciasDependencias;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Dependencias extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'COEJC',
            'sigla_dependencia' => "COEJC",
            'padre_dependencia' => null
        ]);

        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'SECEJ',
            'sigla_dependencia' => "SECEJ",
            'padre_dependencia' => null
        ]);

        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'CEIGE',
            'sigla_dependencia' => "CEIGE",
            'padre_dependencia' => 1
        ]);

        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'COTEF',
            'sigla_dependencia' => "COTEF",
            'padre_dependencia' => 1
        ]);

        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'DICOE',
            'sigla_dependencia' => "DICOE",
            'padre_dependencia' => 1
        ]);

        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'DADAE',
            'sigla_dependencia' => "DADAE",
            'padre_dependencia' => 1
        ]);

        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'OSMEJ',
            'sigla_dependencia' => "OSMEJ",
            'padre_dependencia' => 1
        ]);

        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'CEAYG',
            'sigla_dependencia' => "CEAYG",
            'padre_dependencia' => 2
        ]);

        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'COATE',
            'sigla_dependencia' => "COATE",
            'padre_dependencia' => 2
        ]);

        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'COFIP',
            'sigla_dependencia' => "COFIP",
            'padre_dependencia' => 2
        ]);

        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'DANTE',
            'sigla_dependencia' => "DANTE",
            'padre_dependencia' => 2
        ]);

        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'DIRIE',
            'sigla_dependencia' => "DIRIE",
            'padre_dependencia' => 2
        ]);

        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'OGENE',
            'sigla_dependencia' => "OGENE",
            'padre_dependencia' => 2
        ]);

        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'JEMPP',
            'sigla_dependencia' => "JEMPP",
            'padre_dependencia' => 2
        ]);

        DenpendenciasDependencias::create([  /* 15 */
            'nombre_dependencia' => 'JEMGF',
            'sigla_dependencia' => "JEMGF",
            'padre_dependencia' => 2
        ]);

        /* **** */

        DenpendenciasDependencias::create([  /* 16 */
            'nombre_dependencia' => 'JEMOP',
            'sigla_dependencia' => "JEMOP",
            'padre_dependencia' => 2
        ]);

        DenpendenciasDependencias::create([ /* 17 */
            'nombre_dependencia' => 'JEMIC',
            'sigla_dependencia' => "JEMIC",
            'padre_dependencia' => 2
        ]);

        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'CEDE1',
            'sigla_dependencia' => "CEDE1",
            'padre_dependencia' => 14
        ]);

        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'CEDE2',
            'sigla_dependencia' => "CEDE2",
            'padre_dependencia' => 14
        ]);

        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'CEDE3',
            'sigla_dependencia' => "CEDE3",
            'padre_dependencia' => 14
        ]);

        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'CEDE4',
            'sigla_dependencia' => "CEDE4",
            'padre_dependencia' => 14
        ]);

        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'CEDE5',
            'sigla_dependencia' => "CEDE5",
            'padre_dependencia' => 14
        ]);

        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'CEDE6',
            'sigla_dependencia' => "CEDE6",
            'padre_dependencia' => 14
        ]);

        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'CEDE7',
            'sigla_dependencia' => "CEDE7",
            'padre_dependencia' => 14
        ]);

        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'CEDE8',
            'sigla_dependencia' => "CEDE8",
            'padre_dependencia' => 14
        ]);

        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'CEDE9',
            'sigla_dependencia' => "CEDE9",
            'padre_dependencia' => 14
        ]);

        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'CEDE10',
            'sigla_dependencia' => "CEDE10",
            'padre_dependencia' => 14
        ]);

        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'CEDE11',
            'sigla_dependencia' => "CEDE11",
            'padre_dependencia' => 14
        ]);

        /* ****************** */

        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'COPER',
            'sigla_dependencia' => "COPER",
            'padre_dependencia' => 15
        ]);

        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'COREC',
            'sigla_dependencia' => "COREC",
            'padre_dependencia' => 15
        ]);

        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'CEDOC',
            'sigla_dependencia' => "CEDOC",
            'padre_dependencia' => 15
        ]);

        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'COLOG',
            'sigla_dependencia' => "COLOG",
            'padre_dependencia' => 15
        ]);

        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'COING',
            'sigla_dependencia' => "COING",
            'padre_dependencia' => 15
        ]);

        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'COADE',
            'sigla_dependencia' => "COADE",
            'padre_dependencia' => 15
        ]);

        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'CEDE1',
            'sigla_dependencia' => "CEDE1",
            'padre_dependencia' => 15
        ]);

        /* ****************** */

        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'DIV01',
            'sigla_dependencia' => "DIV01",
            'padre_dependencia' => 16
        ]);

        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'DIV02',
            'sigla_dependencia' => "DIV02",
            'padre_dependencia' => 16
        ]);

        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'DIV03',
            'sigla_dependencia' => "DIV03",
            'padre_dependencia' => 16
        ]);

        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'DIV04',
            'sigla_dependencia' => "DIV04",
            'padre_dependencia' => 16
        ]);

        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'DIV05',
            'sigla_dependencia' => "DIV05",
            'padre_dependencia' => 16
        ]);

        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'DIV06',
            'sigla_dependencia' => "DIV06",
            'padre_dependencia' => 16
        ]);

        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'DIV07',
            'sigla_dependencia' => "DIV07",
            'padre_dependencia' => 16
        ]);

        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'DIV08',
            'sigla_dependencia' => "DIV08",
            'padre_dependencia' => 16
        ]);

        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'FUTOM',
            'sigla_dependencia' => "FUTOM",
            'padre_dependencia' => 16
        ]);

        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'DAVAA',
            'sigla_dependencia' => "DAVAA",
            'padre_dependencia' => 16
        ]);

        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'DIVFE',
            'sigla_dependencia' => "DIVFE",
            'padre_dependencia' => 16
        ]);

        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'CAFUE',
            'sigla_dependencia' => "CAFUE",
            'padre_dependencia' => 16
        ]);

        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'CAAID',
            'sigla_dependencia' => "CAAID",
            'padre_dependencia' => 16
        ]);

        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'CAOCC',
            'sigla_dependencia' => "CAOCC",
            'padre_dependencia' => 16
        ]);

        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'CAOUR',
            'sigla_dependencia' => "CAOUR",
            'padre_dependencia' => 16
        ]);

        /* ************* */

        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'DINCI',
            'sigla_dependencia' => "DINCI",
            'padre_dependencia' => 17
        ]);

        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'DAICO',
            'sigla_dependencia' => "DAICO",
            'padre_dependencia' => 17
        ]);

        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'DIPDI',
            'sigla_dependencia' => "DIPDI",
            'padre_dependencia' => 17
        ]);

        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'CAIMI',
            'sigla_dependencia' => "CAIMI",
            'padre_dependencia' => 17
        ]);

        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'CACIM',
            'sigla_dependencia' => "CACIM",
            'padre_dependencia' => 17
        ]);
    }
}

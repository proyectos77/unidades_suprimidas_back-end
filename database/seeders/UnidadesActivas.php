<?php

namespace Database\Seeders;

use App\Models\Unidades\UnidadesModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnidadesActivas extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //1
        UnidadesModel::create([
            'nombre_unidad' => 'COMANDO DEL EJÉRCITO NACIONAL',
            'sigla_unidad' => "COEJC",
            'codigo_unidad_activa' => "1000",
            'padre_unidad' => null
        ]);

        //2
        UnidadesModel::create([
            'nombre_unidad' => 'SEGUNDO COMANDO DEL EJÉRCITO',
            'sigla_unidad' => "SECEJ",
            'codigo_unidad_activa' => "1500",
            'padre_unidad' => null
        ]);


        /* HIJAS DEL 1 */
        //3
        UnidadesModel::create([
            'nombre_unidad' => 'INSPECCIÓN GENERAL DEL EJÉRCITO NACIONAL',
            'sigla_unidad' => "CEIGE",
            'padre_unidad' => 1,
            'codigo_unidad_activa' => "1010",
        ]);

        //4
        UnidadesModel::create([
            'nombre_unidad' => 'COMANDO DE TRANSFORMACIÓN DEL EJÉRCITO DEL FUTURO',
            'sigla_unidad' => "COTEF",
            'padre_unidad' => 1,
            'codigo_unidad_activa' => "1020",
        ]);

        //5
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN DE COMUNICACIONES ESTRATÉGICAS',
            'sigla_unidad' => "DICOE",
            'padre_unidad' => 1,
            'codigo_unidad_activa' => "1030",
        ]);

        //6
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN DE ASUNTOS DISCIPLINARIOS Y ADMINISTRATIVOS DEL EJÉRCITO NACIONAL',
            'sigla_unidad' => "DADAE",
            'padre_unidad' => 1,
            'codigo_unidad_activa' => "1040",
        ]);

        //7
        UnidadesModel::create([
            'nombre_unidad' => 'OFICINA SARGENTO MAYOR EJÉRCITO',
            'sigla_unidad' => "OSMEJ",
            'padre_unidad' => 1,
            'codigo_unidad_activa' => "1050",
        ]);

        /* HIJAS DEL 4 */
        //8
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN DE TRANSFORMACIÓN INSTITUCIONAL',
            'sigla_unidad' => "DITRI",
            'padre_unidad' => 4,
            'codigo_unidad_activa' => "1021",
        ]);

        //9
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN DE MODERNIZACIÓN',
            'sigla_unidad' => "DIMOD",
            'padre_unidad' => 4,
            'codigo_unidad_activa' => "1022",
        ]);

        //10
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN DE DESARROLLO DE CAPACIDADES',
            'sigla_unidad' => "DIMOD",
            'padre_unidad' => 4,
            'codigo_unidad_activa' => "1023",
        ]);

        /***********************************************************

                ************ HIJAS DEL 2 **********

        ************************************************************/
        //11
        UnidadesModel::create([
            'nombre_unidad' => 'AYUDANTIA GENERAL DEL COMANDO DEL EJÉRCITO',
            'sigla_unidad' => "CEAYG",
            'padre_unidad' => 2,
            'codigo_unidad_activa' => "1501",
        ]);

        /*************** HIJAS DEL 11  PENDIENTES***************/

        //12
        UnidadesModel::create([
            'nombre_unidad' => 'COMANDO DE APOYO TECNOLÓGICO DEL EJÉRCITO NACIONAL',
            'sigla_unidad' => "COATE",
            'padre_unidad' => 2,
            'codigo_unidad_activa' => "1540",
        ]);

        /*************** HIJAS DEL 12 ***************/

        //13
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN APLICACIÓN DE TECNOLOGIAS Y RESULTADOS DE I+D+i',
            'sigla_unidad' => "DIARI",
            'padre_unidad' => 12,
            'codigo_unidad_activa' => "1541",
        ]);

        //14
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN GESTIÓN LOGÍSTICA',
            'sigla_unidad' => "DIGEL",
            'padre_unidad' => 12,
            'codigo_unidad_activa' => "1542",
        ]);

        //15
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN SISTEMA DE CIENCIA Y TECNOLOGÍA DEL EJÉRCITO',
            'sigla_unidad' => "DISTE",
            'padre_unidad' => 12,
            'codigo_unidad_activa' => "1543",
        ]);

        //16
        UnidadesModel::create([
            'nombre_unidad' => 'COMANDO FINANCIERO Y PRESUPUESTAL',
            'sigla_unidad' => "COFIP",
            'padre_unidad' => 2,
            'codigo_unidad_activa' => "1550",
        ]);

        //17
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN DE PRESUPUESTO',
            'sigla_unidad' => "DIPRE",
            'padre_unidad' => 16,
            'codigo_unidad_activa' => "1551",
        ]);

        //18
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN FINANCIERA',
            'sigla_unidad' => "DIFIN",
            'padre_unidad' => 16,
            'codigo_unidad_activa' => "1552",
        ]);

        //19
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN CONTABLE Y TESORERÍA',
            'sigla_unidad' => "DICOT",
            'padre_unidad' => 16,
            'codigo_unidad_activa' => "1553",
        ]);

        //20
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCION DE CONVENIO DE COLAVORACION',
            'sigla_unidad' => "DICCO",
            'padre_unidad' => 16,
            'codigo_unidad_activa' => "1554",
        ]);

        //21
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCION DE CONVENIO DE COLAVORACION',
            'sigla_unidad' => "DICCO",
            'padre_unidad' => 16,
            'codigo_unidad_activa' => "1560",
        ]);

        //22
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN DE RELACIONES INTERNACIONALES DEL EJÉRCITO',
            'sigla_unidad' => "DIRIE",
            'padre_unidad' => 2,
            'codigo_unidad_activa' => "1570",
        ]);

        //23
        UnidadesModel::create([
            'nombre_unidad' => 'OFICINA DE ASUNTOS DISCIPLINARIOS Y ADMINISTRATIVOS',
            'sigla_unidad' => "OADAS",
            'padre_unidad' => 2,
            'codigo_unidad_activa' => "1580",
        ]);

        //24
        UnidadesModel::create([
            'nombre_unidad' => 'OFICINA DE GÉNERO DEL EJÉRCITO NACIONAL',
            'sigla_unidad' => "OGENE",
            'padre_unidad' => 2,
            'codigo_unidad_activa' => "1590",
        ]);

        //25
        UnidadesModel::create([
            'nombre_unidad' => 'JEFATURA DE ESTADO MAYOR DE PLANEACIÓN Y POLÍTICAS',
            'sigla_unidad' => "JEMPP",
            'padre_unidad' => 2,
            'codigo_unidad_activa' => "2000",
        ]);

        //26
        UnidadesModel::create([
            'nombre_unidad' => 'DEPARTAMENTO DE PERSONAL',
            'sigla_unidad' => "CEDE1",
            'padre_unidad' => 25,
            'codigo_unidad_activa' => "2010",
        ]);

        //27
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN DE PLANEACIÓN ESTRATÉGICA DE PERSONAL',
            'sigla_unidad' => "DIPEP",
            'padre_unidad' => 26,
            'codigo_unidad_activa' => "2011",
        ]);

        //28
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN ESTRATÉGICA DE POTENCIAL HUMANO',
            'sigla_unidad' => "DIPOH",
            'padre_unidad' => 26,
            'codigo_unidad_activa' => "2012",
        ]);

        //29
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN DE SISTEMAS DE INFORMACIÓN Y ESTADÍSTICAS DE PERSONAL',
            'sigla_unidad' => "DISEP",
            'padre_unidad' => 26,
            'codigo_unidad_activa' => "2013",
        ]);

        //30
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN DE INVESTIGACIÓN, INNOVACIÓN Y DESARROLLO DE PERSONAL.',
            'sigla_unidad' => "DIDEP",
            'padre_unidad' => 26,
            'codigo_unidad_activa' => "2014",
        ]);

        //31
        UnidadesModel::create([
            'nombre_unidad' => 'DEPARTAMENTO DE INTELIGENCIA Y CONTRAINTELIGENCIA',
            'sigla_unidad' => "CEDE2",
            'padre_unidad' => 25,
            'codigo_unidad_activa' => "2020",
        ]);

        //32
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN DE PLANEACIÓN ESTRATÉGICA DE INTELIGENCIA Y CONTRAINTELIGENCIA',
            'sigla_unidad' => "DIPEI",
            'padre_unidad' => 31,
            'codigo_unidad_activa' => "2021",
        ]);

        //33
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN DE COOPERACIÓN INTERAGENCIAL DE INTELIGENCIA Y CONTRAINTELIGENCIA',
            'sigla_unidad' => "DICOO",
            'padre_unidad' => 31,
            'codigo_unidad_activa' => "2022",
        ]);

        //34
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN DE PROTECCIÓN DE DATOS Y ARCHIVOS',
            'sigla_unidad' => "DIPDA",
            'padre_unidad' => 31,
            'codigo_unidad_activa' => "2023",
        ]);

        //35
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN ADMINISTRATIVA DE INTELIGENCIA Y CONTRAINTELIGENCIA',
            'sigla_unidad' => "DIADI",
            'padre_unidad' => 31,
            'codigo_unidad_activa' => "2024",
        ]);

        //36
        UnidadesModel::create([
            'nombre_unidad' => 'DEPARTAMENTO DE OPERACIONES',
            'sigla_unidad' => "CEDE3",
            'padre_unidad' => 2,
            'codigo_unidad_activa' => "2030",
        ]);

        //37
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN DE PLANES OPERACIONALES',
            'sigla_unidad' => "DIPLO",
            'padre_unidad' => 36,
            'codigo_unidad_activa' => "2031",
        ]);

        //38
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN DE ORGANIZACIÓN ',
            'sigla_unidad' => "DIORG",
            'padre_unidad' => 36,
            'codigo_unidad_activa' => "2032",
        ]);

        //39
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN DE SEGURIDAD DE LA INFRAESTRUCTURA CRÍTICA',
            'sigla_unidad' => "DISIC",
            'padre_unidad' => 36,
            'codigo_unidad_activa' => "2033",
        ]);

        //40
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN DEL SISTEMA ESTADÍSTICO OPERACIONAL',
            'sigla_unidad' => "DISEO",
            'padre_unidad' => 36,
            'codigo_unidad_activa' => "2034",
        ]);

        //41
        UnidadesModel::create([
            'nombre_unidad' => 'DEPARTAMENTO DE LOGÍSTICA',
            'sigla_unidad' => "CEDE4",
            'padre_unidad' => 2,
            'codigo_unidad_activa' => "2040",
        ]);

        //42
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN DE PLANEAMIENTO Y ESTRATEGIA LOGÍSTICA',
            'sigla_unidad' => "DIPEL",
            'padre_unidad' => 41,
            'codigo_unidad_activa' => "2041",
        ]);

        //43
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN DE ESTRUCTURACIÓN TÉCNICA',
            'sigla_unidad' => "DIPEL",
            'padre_unidad' => 41,
            'codigo_unidad_activa' => "2042",
        ]);

        //44
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN DE SISTEMAS DE INFORMACIÓN LOGÍSTICA',
            'sigla_unidad' => "DISIL",
            'padre_unidad' => 41,
            'codigo_unidad_activa' => "2043",
        ]);

        //45
        UnidadesModel::create([
            'nombre_unidad' => 'DEPARTAMENTO DE PLANEACIÓN',
            'sigla_unidad' => "CEDE5",
            'padre_unidad' => 2,
            'codigo_unidad_activa' => "2050",
        ]);

        //46
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN DE PLANEAMIENTO ESTRATÉGICO',
            'sigla_unidad' => "DIPLE",
            'padre_unidad' => 45,
            'codigo_unidad_activa' => "2051",
        ]);

        //47
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN DE GESTIÓN DE PROYECTOS',
            'sigla_unidad' => "DIPLE",
            'padre_unidad' => 45,
            'codigo_unidad_activa' => "2052",
        ]);

        //48
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN DE PLANEACIÓN PRESUPUESTAL',
            'sigla_unidad' => "DIPAP",
            'padre_unidad' => 45,
            'codigo_unidad_activa' => "2053",
        ]);

        //49
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN DE SEGUIMIENTO Y EVALUACIÓN',
            'sigla_unidad' => "DISEV",
            'padre_unidad' => 45,
            'codigo_unidad_activa' => "2054",
        ]);

        //50
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN DE GESTIÓN DE CALIDAD',
            'sigla_unidad' => "DIGEC",
            'padre_unidad' => 45,
            'codigo_unidad_activa' => "2055",
        ]);

        //51
        UnidadesModel::create([
            'nombre_unidad' => 'DEPARTAMENTO DE COMUNICACIONES',
            'sigla_unidad' => "CEDE6",
            'padre_unidad' => 2,
            'codigo_unidad_activa' => "2060",
        ]);

        //52
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN DE PLANEACIÓN Y POLÍTICAS C5',
            'sigla_unidad' => "DIPOC",
            'padre_unidad' => 51,
            'codigo_unidad_activa' => "2061",
        ]);

        //53
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN DE PROSPECTIVA E INNOVACIÓN C5',
            'sigla_unidad' => "DIPIC",
            'padre_unidad' => 51,
            'codigo_unidad_activa' => "2062",
        ]);

        //54
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN DE PROYECTOS C5',
            'sigla_unidad' => "DIPCO",
            'padre_unidad' => 51,
            'codigo_unidad_activa' => "2063",
        ]);

        //55
        UnidadesModel::create([
            'nombre_unidad' => 'DEPARTAMENTO DE EDUCACIÓN MILITAR',
            'sigla_unidad' => "CEDE7",
            'padre_unidad' => 2,
            'codigo_unidad_activa' => "2070",
        ]);

        //56
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN DE PLANEACIÓN DE INSTRUCCIÓN Y ENTRENAMIENTO',
            'sigla_unidad' => "DIPIE",
            'padre_unidad' => 55,
            'codigo_unidad_activa' => "2071",
        ]);

        //57
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN DE PLANEACIÓN DE EDUCACIÓN',
            'sigla_unidad' => "DIPED",
            'padre_unidad' => 55,
            'codigo_unidad_activa' => "2072",
        ]);

        //58
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN DE PLANEACIÓN EN CIENCIA Y TECNOLOGÍA',
            'sigla_unidad' => "DIPTE",
            'padre_unidad' => 55,
            'codigo_unidad_activa' => "2073",
        ]);

        //59
        UnidadesModel::create([
            'nombre_unidad' => 'DEPARTAMENTO DE GESTIÓN FISCAL',
            'sigla_unidad' => "CEDE8",
            'padre_unidad' => 2,
            'codigo_unidad_activa' => "2080",
        ]);

        //60
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN DE SUSTENTABILIDAD FISCAL',
            'sigla_unidad' => "DISFI",
            'padre_unidad' => 59,
            'codigo_unidad_activa' => "2081",
        ]);

        //61
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN DE ANÁLISIS Y DESARROLLO ADMINISTRATIVO',
            'sigla_unidad' => "DIADA",
            'padre_unidad' => 59,
            'codigo_unidad_activa' => "2082",
        ]);

        //62
        UnidadesModel::create([
            'nombre_unidad' => 'DEPARTAMENTO DE ACCIÓN INTEGRAL Y DESARROLLO',
            'sigla_unidad' => "CEDE9",
            'padre_unidad' => 2,
            'codigo_unidad_activa' => "2090",
        ]);

        //63
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN DE PLANES ESTRATÉGICOS DE ACCIÓN INTEGRAL Y DESARROLLO',
            'sigla_unidad' => "DIPAI",
            'padre_unidad' => 62,
            'codigo_unidad_activa' => "2091",
        ]);

        //64
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN DE COOPERACIÓN CIVIL Y MILITAR',
            'sigla_unidad' => "DICMI",
            'padre_unidad' => 62,
            'codigo_unidad_activa' => "2092",
        ]);

        //65
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN DE ASUNTOS CIVILES Y COORDINACIÓN INTERINSTITUCIONAL',
            'sigla_unidad' => "DIACO",
            'padre_unidad' => 62,
            'codigo_unidad_activa' => "2093",
        ]);

        //66
        UnidadesModel::create([
            'nombre_unidad' => 'DEPARTAMENTO DE INGENIEROS MILITARES',
            'sigla_unidad' => "CEDE10",
            'padre_unidad' => 2,
            'codigo_unidad_activa' => "2100",
        ]);

        //67
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN DE ESTRATEGIAS Y POLÍTICAS DE INGENIEROS',
            'sigla_unidad' => "DIESP",
            'padre_unidad' => 66,
            'codigo_unidad_activa' => "2101",
        ]);

        //68
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN DE PLANEACIÓN DE INGENIEROS',
            'sigla_unidad' => "DIPLI",
            'padre_unidad' => 66,
            'codigo_unidad_activa' => "2102",
        ]);

        //69
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN DE INGENIEROS DE COMBATE',
            'sigla_unidad' => "DINCO",
            'padre_unidad' => 66,
            'codigo_unidad_activa' => "2103",
        ]);

        //70
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN GESTIÓN DE INGENIEROS',
            'sigla_unidad' => "DIGEI",
            'padre_unidad' => 66,
            'codigo_unidad_activa' => "2104",
        ]);

        //71
        UnidadesModel::create([
            'nombre_unidad' => 'DEPARTAMENTO JURÍDICO INTEGRAL',
            'sigla_unidad' => "CEDE11",
            'padre_unidad' => 2,
            'codigo_unidad_activa' => "2110",
        ]);

        //72
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN DE PLANEACIÓN Y POLÍTICAS JURÍDICAS',
            'sigla_unidad' => "DIPOJ",
            'padre_unidad' => 71,
            'codigo_unidad_activa' => "2111",
        ]);

        //73
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN DE NEGOCIOS GENERALES',
            'sigla_unidad' => "DINEG",
            'padre_unidad' => 71,
            'codigo_unidad_activa' => "2112",
        ]);

        //74
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN DE DERECHO OPERACIONAL Y DERECHOS HUMANOS',
            'sigla_unidad' => "DIDOH",
            'padre_unidad' => 71,
            'codigo_unidad_activa' => "2113",
        ]);

        //75
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN DE DIFUSIÓN, PROMOCIÓN Y PREVENCIÓN',
            'sigla_unidad' => "DIDIP",
            'padre_unidad' => 71,
            'codigo_unidad_activa' => "2114",
        ]);

        //76
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN DE DEFENSA JURÍDICA INTEGRAL',
            'sigla_unidad' => "DIDEF",
            'padre_unidad' => 71,
            'codigo_unidad_activa' => "2115",
        ]);

        //77
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN DE APOYO A LA TRANSICIÓN',
            'sigla_unidad' => "DATRA",
            'padre_unidad' => 71,
            'codigo_unidad_activa' => "2116",
        ]);

        //78
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN DE ANÁLISIS PARA EL FORTALECIMIENTO INSTITUCIONAL',
            'sigla_unidad' => "DIAFI",
            'padre_unidad' => 71,
            'codigo_unidad_activa' => "2117",
        ]);

        //79
        UnidadesModel::create([
            'nombre_unidad' => 'JEFATURA DE ESTADO MAYOR GENERADOR DE FUERZA',
            'sigla_unidad' => "JEMGF",
            'padre_unidad' => null,
            'codigo_unidad_activa' => "3000",
        ]);

        //80
        UnidadesModel::create([
            'nombre_unidad' => 'COMANDO DE PERSONAL',
            'sigla_unidad' => "COPER",
            'padre_unidad' => 79,
            'codigo_unidad_activa' => "3010",
        ]);

        //81
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN DE PERSONAL',
            'sigla_unidad' => "DIPER",
            'padre_unidad' => 80,
            'codigo_unidad_activa' => "3011",
        ]);

        //82
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN DE GESTIÓN HUMANA POR COMPETENCIAS',
            'sigla_unidad' => "DIGEH",
            'padre_unidad' => 80,
            'codigo_unidad_activa' => "3030",
        ]);

        //83
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN DE PRESTACIONES SOCIALES',
            'sigla_unidad' => "DIPSO",
            'padre_unidad' => 80,
            'codigo_unidad_activa' => "3170",
        ]);

        //84
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN DE PRESERVACIÓN DE LA INTEGRIDAD Y SEGURIDAD DEL EJÉRCITO',
            'sigla_unidad' => "DIPSE",
            'padre_unidad' => 80,
            'codigo_unidad_activa' => "3135",
        ]);

        //85
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN DE SANIDAD',
            'sigla_unidad' => "DISAN",
            'padre_unidad' => 80,
            'codigo_unidad_activa' => "3040",
        ]);

        //86
        UnidadesModel::create([
            'nombre_unidad' => 'DISPENSARIO MÉDICO ORIENTE - NIVEL 2A',
            'sigla_unidad' => "DMORI",
            'padre_unidad' => 85,
            'codigo_unidad_activa' => "3041",
        ]);

        //87
        UnidadesModel::create([
            'nombre_unidad' => 'DISPENSARIO MÉDICO BUCARAMANGA - NIVEL 2B',
            'sigla_unidad' => "DMBUG",
            'padre_unidad' => 85,
            'codigo_unidad_activa' => "3060",
        ]);

        //88
        UnidadesModel::create([
            'nombre_unidad' => 'DISPENSARIO MÉDICO MEDELLÍN - NIVEL 2B',
            'sigla_unidad' => "DMMED",
            'padre_unidad' => 85,
            'codigo_unidad_activa' => "3075",
        ]);

        //89
        UnidadesModel::create([
            'nombre_unidad' => 'DISPENSARIO MÉDICO TOLEMAIDA - NIVEL 2C',
            'sigla_unidad' => "DMTOL",
            'padre_unidad' => 85,
            'codigo_unidad_activa' => "3090",
        ]);

       /*  //90
        UnidadesModel::create([
            'nombre_unidad' => 'DISPENSARIO MÉDICO TOLEMAIDA - NIVEL 2C',
            'sigla_unidad' => "DMTOL",
            'padre_unidad' => 85,
            'codigo_unidad_activa' => "3090",
        ]); */

        //90
        UnidadesModel::create([
            'nombre_unidad' => 'DISPENSARIO MÉDICO SUROCCIDENTE- NIVEL 2D',
            'sigla_unidad' => "DMSOC",
            'padre_unidad' => 85,
            'codigo_unidad_activa' => "3105",
        ]);

        //91
        UnidadesModel::create([
            'nombre_unidad' => 'DISPENSARIO MÉDICO GILBERTO ECHEVERRY MEJIA - NIVEL 2E',
            'sigla_unidad' => "DMGEM",
            'padre_unidad' => 85,
            'codigo_unidad_activa' => "3119",
        ]);

        //92
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN DE FAMILIA Y BIENESTAR',
            'sigla_unidad' => "DIFAB",
            'padre_unidad' => 80,
            'codigo_unidad_activa' => "3136",
        ]);

        //93
        UnidadesModel::create([
            'nombre_unidad' => 'SEDE HABITACIONAL CRISTÓBAL COLÓN',
            'sigla_unidad' => "DIFAB",
            'padre_unidad' => 92,
            'codigo_unidad_activa' => "3137",
        ]);

        //94
        UnidadesModel::create([
            'nombre_unidad' => 'SEDE HABITACIONAL BICENTENARIO DE LA INDEPENDENCIA',
            'sigla_unidad' => "DIFAB",
            'padre_unidad' => 92,
            'codigo_unidad_activa' => "3138",
        ]);

        //95
        UnidadesModel::create([
            'nombre_unidad' => 'CENTRO RECREACIONAL SAN FERNANDO',
            'sigla_unidad' => "DIFAB",
            'padre_unidad' => 92,
            'codigo_unidad_activa' => "3139",
        ]);

        //96
        UnidadesModel::create([
            'nombre_unidad' => 'CENTRO RECREACIONAL EJE CAFETERO',
            'sigla_unidad' => "DIFAB",
            'padre_unidad' => 92,
            'codigo_unidad_activa' => "3140",
        ]);

        //97
        UnidadesModel::create([
            'nombre_unidad' => 'CENTRO RECREACIONAL SAN SEBASTIÁN',
            'sigla_unidad' => "DIFAB",
            'padre_unidad' => 92,
            'codigo_unidad_activa' => "3141",
        ]);

        //98
        UnidadesModel::create([
            'nombre_unidad' => 'CENTRO RECREACIONAL VILLA DE LEYVA',
            'sigla_unidad' => "DIFAB",
            'padre_unidad' => 92,
            'codigo_unidad_activa' => "3142",
        ]);

        //99
        UnidadesModel::create([
            'nombre_unidad' => 'COLEGIO BACHILLERATO PATRIA',
            'sigla_unidad' => "DIFAB",
            'padre_unidad' => 92,
            'codigo_unidad_activa' => "3144",
        ]);

        //100
        UnidadesModel::create([
            'nombre_unidad' => 'LICEO SANTA BÁRBARA',
            'sigla_unidad' => "DIFAB",
            'padre_unidad' => 92,
            'codigo_unidad_activa' => "3145",
        ]);

        //101
        UnidadesModel::create([
            'nombre_unidad' => 'LICEO COLOMBIA',
            'sigla_unidad' => "DIFAB",
            'padre_unidad' => 92,
            'codigo_unidad_activa' => "3146",
        ]);

        //102
        UnidadesModel::create([
            'nombre_unidad' => 'LICEO PATRIA',
            'sigla_unidad' => "DIFAB",
            'padre_unidad' => 92,
            'codigo_unidad_activa' => "3147",
        ]);

        //103
        UnidadesModel::create([
            'nombre_unidad' => 'LICEO FRANCISCO JULIÁN OLAYA',
            'sigla_unidad' => "DIFAB",
            'padre_unidad' => 92,
            'codigo_unidad_activa' => "3148",
        ]);

        //104
        UnidadesModel::create([
            'nombre_unidad' => 'LICEO GUSTAVO MATAMORO LEÓN',
            'sigla_unidad' => "DIFAB",
            'padre_unidad' => 92,
            'codigo_unidad_activa' => "3149",
        ]);

        //105
        UnidadesModel::create([
            'nombre_unidad' => 'LICEO FRANCISCO JOSÉ DE CALDAS',
            'sigla_unidad' => "DIFAB",
            'padre_unidad' => 92,
            'codigo_unidad_activa' => "3150",
        ]);

        //106
        UnidadesModel::create([
            'nombre_unidad' => 'LICEO GENERAL SERVIEZ',
            'sigla_unidad' => "DIFAB",
            'padre_unidad' => 92,
            'codigo_unidad_activa' => "3151",
        ]);

        //107
        UnidadesModel::create([
            'nombre_unidad' => 'LICEO PICHINCHA',
            'sigla_unidad' => "DIFAB",
            'padre_unidad' => 92,
            'codigo_unidad_activa' => "3152",
        ]);

        //108
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN DE CENTROS DE RECLUSIÓN MILITAR',
            'sigla_unidad' => "DICER",
            'padre_unidad' => 80,
            'codigo_unidad_activa' => "3160",
        ]);

        //109
        UnidadesModel::create([
            'nombre_unidad' => 'ESTABLECIMIENTO PENITENCIARIO Y CARCELARIO EN EL BATALLÓN DE INGENIEROS No. 04 "Gn. PEDRO NEL OSPINA"',
            'sigla_unidad' => "EJEBE",
            'padre_unidad' => 108,
            'codigo_unidad_activa' => "3161",
        ]);

        //110
        UnidadesModel::create([
            'nombre_unidad' => 'ESTABLECIMIENTO PENITENCIARIO Y CARCELARIO EN EL BATALLÓN DE POLICÍA MILITAR No.13 "Gn.TOMAS CIPRIANO DE MOSQUERA"',
            'sigla_unidad' => "EJEPO",
            'padre_unidad' => 108,
            'codigo_unidad_activa' => "3162",
        ]);

        //111
        UnidadesModel::create([
            'nombre_unidad' => 'ESTABLECIMIENTO PENITENCIARIO Y CARCELARIO BATALLÓN DE ARTILLERÍA No.13 "Gn. FERNANDO LANDAZÁBAL REYES"',
            'sigla_unidad' => "EJART",
            'padre_unidad' => 108,
            'codigo_unidad_activa' => "3163",
        ]);

        //112
        UnidadesModel::create([
            'nombre_unidad' => 'CENTRO DE RECLUSIÓN MILITAR EN EL BATALLÓN DE POLICÍA MILITAR No.3 "GR. EUSEBIO BORRERO ACOSTA"',
            'sigla_unidad' => "EJECA",
            'padre_unidad' => 108,
            'codigo_unidad_activa' => "3164",
        ]);

        //113
        UnidadesModel::create([
            'nombre_unidad' => 'CENTRO DE RECLUSIÓN MILITAR EN EL BATALLÓN DE A.S.P.C. No.10 "CACIQUE UPARE"',
            'sigla_unidad' => "EJUPA",
            'padre_unidad' => 108,
            'codigo_unidad_activa' => "3165",
        ]);

        //114
        UnidadesModel::create([
            'nombre_unidad' => 'CENTRO DE RECLUSIÓN MILITAR EN EL BATALLÓN DE COMUNICACIONES No.1 "MANUEL MURILLO TORO"',
            'sigla_unidad' => "EJECO",
            'padre_unidad' => 108,
            'codigo_unidad_activa' => "3166",
        ]);

        //115
        UnidadesModel::create([
            'nombre_unidad' => 'CENTRO DE RECLUSIÓN MILITAR EN EL BATALLÓN DE A.S.P.C. No.7 "ANTONIA SANTOS"',
            'sigla_unidad' => "EJAPI",
            'padre_unidad' => 108,
            'codigo_unidad_activa' => "3167",
        ]);

        //116
        UnidadesModel::create([
            'nombre_unidad' => 'CENTRO DE RECLUSIÓN MILITAR EN EL BATALLÓN DE A.S.P.C. No.16 "TE. WILLIAN RAMIREZ SILVA"',
            'sigla_unidad' => "EJEYO",
            'padre_unidad' => 108,
            'codigo_unidad_activa' => "3168",
        ]);

        //117
        UnidadesModel::create([
            'nombre_unidad' => 'CENTRO DE RECLUSIÓN MILITAR EN EL BATALLÓN DE INGENIEROS No.2 "Gn. FRANCISCO JAVIER VERGARA Y VELASCO"',
            'sigla_unidad' => "EJEMA",
            'padre_unidad' => 108,
            'codigo_unidad_activa' => "3169",
        ]);

        //118
        UnidadesModel::create([
            'nombre_unidad' => 'COMANDO DE RECLUTAMIENTO Y CONTROL RESERVAS',
            'sigla_unidad' => "COREC",
            'padre_unidad' => 79,
            'codigo_unidad_activa' => "3171",
        ]);

        //119
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN DE CONTROL RESERVAS',
            'sigla_unidad' => "DICOR",
            'padre_unidad' => 118,
            'codigo_unidad_activa' => "3310",
        ]);

        //120
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN DE INFORMÁTICA Y COMUNICACIONES',
            'sigla_unidad' => "DIRIC",
            'padre_unidad' => 118,
            'codigo_unidad_activa' => "3311",
        ]);

        //121
        UnidadesModel::create([
            'nombre_unidad' => 'DIRECCIÓN DE RECLUTAMIENTO',
            'sigla_unidad' => "DIREC",
            'padre_unidad' => 118,
            'codigo_unidad_activa' => "3172",
        ]);

        //122
        UnidadesModel::create([
            'nombre_unidad' => 'Zona 1',
            'sigla_unidad' => "Zona1",
            'padre_unidad' => 121,
            'codigo_unidad_activa' => "3173",
        ]);

        //123
        UnidadesModel::create([
            'nombre_unidad' => 'Distrito Militar No.06',
            'sigla_unidad' => "DIM06",
            'padre_unidad' => 122,
            'codigo_unidad_activa' => "3174",
        ]);

        //124
        UnidadesModel::create([
            'nombre_unidad' => 'Distrito Militar No.07',
            'sigla_unidad' => "DIM07",
            'padre_unidad' => 122,
            'codigo_unidad_activa' => "3175",
        ]);

        //125
        UnidadesModel::create([
            'nombre_unidad' => 'Distrito Militar No.08',
            'sigla_unidad' => "DIM08",
            'padre_unidad' => 122,
            'codigo_unidad_activa' => "3176",
        ]);

        //126
        UnidadesModel::create([
            'nombre_unidad' => 'Distrito Militar No.49',
            'sigla_unidad' => "DIM49",
            'padre_unidad' => 122,
            'codigo_unidad_activa' => "3177",
        ]);

        //127
        UnidadesModel::create([
            'nombre_unidad' => 'Zona 2',
            'sigla_unidad' => "Zona2",
            'padre_unidad' => 121,
            'codigo_unidad_activa' => "3180",
        ]);

        //128
        UnidadesModel::create([
            'nombre_unidad' => 'Distrito Militar No.10',
            'sigla_unidad' => "DIM10",
            'padre_unidad' => 127,
            'codigo_unidad_activa' => "3181",
        ]);

        //129
        UnidadesModel::create([
            'nombre_unidad' => 'Distrito Militar No.12',
            'sigla_unidad' => "DIM12",
            'padre_unidad' => 127,
            'codigo_unidad_activa' => "3182",
        ]);

        //130
        UnidadesModel::create([
            'nombre_unidad' => 'Distrito Militar No.14',
            'sigla_unidad' => "DIM14",
            'padre_unidad' => 127,
            'codigo_unidad_activa' => "3183",
        ]);

        //131
        UnidadesModel::create([
            'nombre_unidad' => 'Distrito Militar No.15',
            'sigla_unidad' => "DIM15",
            'padre_unidad' => 127,
            'codigo_unidad_activa' => "3184",
        ]);

        //132
        UnidadesModel::create([
            'nombre_unidad' => 'Distrito Militar No.44',
            'sigla_unidad' => "DIM44",
            'padre_unidad' => 127,
            'codigo_unidad_activa' => "3185",
        ]);

         //133
        UnidadesModel::create([
            'nombre_unidad' => 'Distrito Militar No.45',
            'sigla_unidad' => "DIM45",
            'padre_unidad' => 127,
            'codigo_unidad_activa' => "3186",
        ]);

        //134
        UnidadesModel::create([
            'nombre_unidad' => 'Zona3',
            'sigla_unidad' => "Zona3",
            'padre_unidad' => 121,
            'codigo_unidad_activa' => "3190",
        ]);

        //135
        UnidadesModel::create([
            'nombre_unidad' => 'Distrito Militar No.16',
            'sigla_unidad' => "DIM16",
            'padre_unidad' => 134,
            'codigo_unidad_activa' => "3191",
        ]);

        //136
        UnidadesModel::create([
            'nombre_unidad' => 'Distrito Militar No.17',
            'sigla_unidad' => "DIM17",
            'padre_unidad' => 134,
            'codigo_unidad_activa' => "3192",
        ]);

        //137
        UnidadesModel::create([
            'nombre_unidad' => 'Distrito Militar No.18',
            'sigla_unidad' => "DIM18",
            'padre_unidad' => 134,
            'codigo_unidad_activa' => "3193",
        ]);

        //138
        UnidadesModel::create([
            'nombre_unidad' => 'Distrito Militar No.19',
            'sigla_unidad' => "DIM19",
            'padre_unidad' => 134,
            'codigo_unidad_activa' => "3194",
        ]);

        //139
        UnidadesModel::create([
            'nombre_unidad' => 'Distrito Militar No.20',
            'sigla_unidad' => "DIM20",
            'padre_unidad' => 134,
            'codigo_unidad_activa' => "3195",
        ]);

        //140
        UnidadesModel::create([
            'nombre_unidad' => 'Distrito Militar No.21',
            'sigla_unidad' => "DIM21",
            'padre_unidad' => 134,
            'codigo_unidad_activa' => "3196",
        ]);

        //141
        UnidadesModel::create([
            'nombre_unidad' => 'Distrito Militar No.23',
            'sigla_unidad' => "DIM23",
            'padre_unidad' => 134,
            'codigo_unidad_activa' => "3197",
        ]);

        //142
        UnidadesModel::create([
            'nombre_unidad' => 'Distrito Militar No.58',
            'sigla_unidad' => "DIM58",
            'padre_unidad' => 134,
            'codigo_unidad_activa' => "3198",
        ]);


        //143
        UnidadesModel::create([
            'nombre_unidad' => 'Zona4',
            'sigla_unidad' => "Zona4",
            'padre_unidad' => 121,
            'codigo_unidad_activa' => "3200",
        ]);

        //144
        UnidadesModel::create([
            'nombre_unidad' => 'Zona5',
            'sigla_unidad' => "Zona5",
            'padre_unidad' => 121,
            'codigo_unidad_activa' => "3210",
        ]);

        //145
        UnidadesModel::create([
            'nombre_unidad' => 'Distrito Militar No.32',
            'sigla_unidad' => "DIM32",
            'padre_unidad' => 144,
            'codigo_unidad_activa' => "3211",
        ]);

        //146
        UnidadesModel::create([
            'nombre_unidad' => 'Distrito Militar No.33',
            'sigla_unidad' => "DIM33",
            'padre_unidad' => 144,
            'codigo_unidad_activa' => "3212",
        ]);

        //147
        UnidadesModel::create([
            'nombre_unidad' => 'Distrito Militar No.34',
            'sigla_unidad' => "DIM34",
            'padre_unidad' => 144,
            'codigo_unidad_activa' => "3213",
        ]);

        //148
        UnidadesModel::create([
            'nombre_unidad' => 'Distrito Militar No.35',
            'sigla_unidad' => "DIM35",
            'padre_unidad' => 144,
            'codigo_unidad_activa' => "3214",
        ]);

        //149
        UnidadesModel::create([
            'nombre_unidad' => 'Distrito Militar No.36',
            'sigla_unidad' => "DIM36",
            'padre_unidad' => 144,
            'codigo_unidad_activa' => "3215",
        ]);

        //150
        UnidadesModel::create([
            'nombre_unidad' => 'Distrito Militar No.37',
            'sigla_unidad' => "DIM37",
            'padre_unidad' => 144,
            'codigo_unidad_activa' => "3216",
        ]);

        //151
        UnidadesModel::create([
            'nombre_unidad' => 'Distrito Militar No.53',
            'sigla_unidad' => "DIM53",
            'padre_unidad' => 144,
            'codigo_unidad_activa' => "3217",
        ]);

        //152
        UnidadesModel::create([
            'nombre_unidad' => 'Zona6',
            'sigla_unidad' => "Zona6",
            'padre_unidad' => 121,
            'codigo_unidad_activa' => "3220",
        ]);

        //153
        UnidadesModel::create([
            'nombre_unidad' => 'Distrito Militar No.38',
            'sigla_unidad' => "DIM38",
            'padre_unidad' => 152,
            'codigo_unidad_activa' => "3221",
        ]);

        //154
        UnidadesModel::create([
            'nombre_unidad' => 'Distrito Militar No.40',
            'sigla_unidad' => "DIM40",
            'padre_unidad' => 152,
            'codigo_unidad_activa' => "3222",
        ]);

        //155
        UnidadesModel::create([
            'nombre_unidad' => 'Distrito Militar No.41',
            'sigla_unidad' => "DIM41",
            'padre_unidad' => 152,
            'codigo_unidad_activa' => "3223",
        ]);

        //156
        UnidadesModel::create([
            'nombre_unidad' => 'Distrito Militar No.57',
            'sigla_unidad' => "DIM57",
            'padre_unidad' => 152,
            'codigo_unidad_activa' => "3224",
        ]);

        //157
        UnidadesModel::create([
            'nombre_unidad' => 'Zona7',
            'sigla_unidad' => "Zona7",
            'padre_unidad' => 121,
            'codigo_unidad_activa' => "3230",
        ]);

        //158
        UnidadesModel::create([
            'nombre_unidad' => 'Distrito Militar No.05',
            'sigla_unidad' => "DIM05",
            'padre_unidad' => 157,
            'codigo_unidad_activa' => "3231",
        ]);

        //159
        UnidadesModel::create([
            'nombre_unidad' => 'Distrito Militar No.09',
            'sigla_unidad' => "DIM09",
            'padre_unidad' => 157,
            'codigo_unidad_activa' => "3232",
        ]);

        //160
        UnidadesModel::create([
            'nombre_unidad' => 'Distrito Militar No.54',
            'sigla_unidad' => "DIM54",
            'padre_unidad' => 157,
            'codigo_unidad_activa' => "3233",
        ]);

        //161
        UnidadesModel::create([
            'nombre_unidad' => 'Zona8',
            'sigla_unidad' => "Zona8",
            'padre_unidad' => 121,
            'codigo_unidad_activa' => "3240",
        ]);

        //162
        UnidadesModel::create([
            'nombre_unidad' => 'Distrito Militar No.22',
            'sigla_unidad' => "DIM22",
            'padre_unidad' => 161,
            'codigo_unidad_activa' => "3241",
        ]);

        //163
        UnidadesModel::create([
            'nombre_unidad' => 'Distrito Militar No.30',
            'sigla_unidad' => "DIM30",
            'padre_unidad' => 161,
            'codigo_unidad_activa' => "3242",
        ]);

        //164
        UnidadesModel::create([
            'nombre_unidad' => 'Distrito Militar No.31',
            'sigla_unidad' => "DIM31",
            'padre_unidad' => 161,
            'codigo_unidad_activa' => "3243",
        ]);

        //165
        UnidadesModel::create([
            'nombre_unidad' => 'Distrito Militar No.39',
            'sigla_unidad' => "DIM39",
            'padre_unidad' => 161,
            'codigo_unidad_activa' => "3244",
        ]);

        //166
        UnidadesModel::create([
            'nombre_unidad' => 'Zona9',
            'sigla_unidad' => "Zona9",
            'padre_unidad' => 121,
            'codigo_unidad_activa' => "3250",
        ]);

        //167
        UnidadesModel::create([
            'nombre_unidad' => 'Distrito Militar No.42',
            'sigla_unidad' => "DIM42",
            'padre_unidad' => 166,
            'codigo_unidad_activa' => "3251",
        ]);

        //168
        UnidadesModel::create([
            'nombre_unidad' => 'Distrito Militar No.43',
            'sigla_unidad' => "DIM43",
            'padre_unidad' => 166,
            'codigo_unidad_activa' => "3252",
        ]);

        //169
        UnidadesModel::create([
            'nombre_unidad' => 'Distrito Militar No.56',
            'sigla_unidad' => "DIM56",
            'padre_unidad' => 166,
            'codigo_unidad_activa' => "3253",
        ]);

        //170
        UnidadesModel::create([
            'nombre_unidad' => 'Distrito Militar No.62',
            'sigla_unidad' => "DIM62",
            'padre_unidad' => 166,
            'codigo_unidad_activa' => "3254",
        ]);

        //171
        UnidadesModel::create([
            'nombre_unidad' => 'Zona10',
            'sigla_unidad' => "Zona10",
            'padre_unidad' => 121,
            'codigo_unidad_activa' => "3260",
        ]);


        //172
        UnidadesModel::create([
            'nombre_unidad' => 'Zona11',
            'sigla_unidad' => "Zona11",
            'padre_unidad' => 121,
            'codigo_unidad_activa' => "3270",
        ]);

        //173
        UnidadesModel::create([
            'nombre_unidad' => 'Distrito Militar No.11',
            'sigla_unidad' => "DIM11",
            'padre_unidad' => 172,
            'codigo_unidad_activa' => "3271",
        ]);

        //174
        UnidadesModel::create([
            'nombre_unidad' => 'Distrito Militar No.13',
            'sigla_unidad' => "DIM13",
            'padre_unidad' => 172,
            'codigo_unidad_activa' => "3272",
        ]);

        //175
        UnidadesModel::create([
            'nombre_unidad' => 'Distrito Militar No.61',
            'sigla_unidad' => "DIM61",
            'padre_unidad' => 172,
            'codigo_unidad_activa' => "3273",
        ]);

        //176
        UnidadesModel::create([
            'nombre_unidad' => 'Zona12',
            'sigla_unidad' => "Zona12",
            'padre_unidad' => 121,
            'codigo_unidad_activa' => "3280",
        ]);

        //177
        UnidadesModel::create([
            'nombre_unidad' => 'Zona13',
            'sigla_unidad' => "Zona13",
            'padre_unidad' => 121,
            'codigo_unidad_activa' => "3290",
        ]);

        //178
        UnidadesModel::create([
            'nombre_unidad' => 'Distrito Militar No.46',
            'sigla_unidad' => "DIM46",
            'padre_unidad' => 177,
            'codigo_unidad_activa' => "3291",
        ]);

        //179
        UnidadesModel::create([
            'nombre_unidad' => 'Distrito Militar No.47',
            'sigla_unidad' => "DIM47",
            'padre_unidad' => 177,
            'codigo_unidad_activa' => "3292",
        ]);

        //180
        UnidadesModel::create([
            'nombre_unidad' => 'Distrito Militar No.51',
            'sigla_unidad' => "DIM51",
            'padre_unidad' => 177,
            'codigo_unidad_activa' => "3293",
        ]);

        //181
        UnidadesModel::create([
            'nombre_unidad' => 'Distrito Militar No.52',
            'sigla_unidad' => "DIM52",
            'padre_unidad' => 177,
            'codigo_unidad_activa' => "3294",
        ]);

        //182
        UnidadesModel::create([
            'nombre_unidad' => 'Distrito Militar No.55',
            'sigla_unidad' => "DIM55",
            'padre_unidad' => 177,
            'codigo_unidad_activa' => "3295",
        ]);

        //183
        UnidadesModel::create([
            'nombre_unidad' => 'Distrito Militar No.59',
            'sigla_unidad' => "DIM59",
            'padre_unidad' => 177,
            'codigo_unidad_activa' => "3296",
        ]);

        //184
        UnidadesModel::create([
            'nombre_unidad' => 'Zona15',
            'sigla_unidad' => "Zona15",
            'padre_unidad' => 121,
            'codigo_unidad_activa' => "3300",
        ]);

        //185
        UnidadesModel::create([
            'nombre_unidad' => 'Distrito Militar No.01',
            'sigla_unidad' => "DIM01",
            'padre_unidad' => 184,
            'codigo_unidad_activa' => "3301",
        ]);

        //186
        UnidadesModel::create([
            'nombre_unidad' => 'Distrito Militar No.02',
            'sigla_unidad' => "DIM02",
            'padre_unidad' => 185,
            'codigo_unidad_activa' => "3302",
        ]);

        //187
        UnidadesModel::create([
            'nombre_unidad' => 'Distrito Militar No.03',
            'sigla_unidad' => "DIM03",
            'padre_unidad' => 185,
            'codigo_unidad_activa' => "3303",
        ]);

        //188
        UnidadesModel::create([
            'nombre_unidad' => 'Distrito Militar No.04',
            'sigla_unidad' => "DIM04",
            'padre_unidad' => 185,
            'codigo_unidad_activa' => "3304",
        ]);

        //189
        UnidadesModel::create([
            'nombre_unidad' => 'Distrito Militar No.60',
            'sigla_unidad' => "DIM60",
            'padre_unidad' => 185,
            'codigo_unidad_activa' => "3305",
        ]);

        //190
        UnidadesModel::create([
            'nombre_unidad' => 'COMANDO DE EDUCACIÓN Y DOCTRINA',
            'sigla_unidad' => "CEDOC",
            'padre_unidad' => 79,
            'codigo_unidad_activa' => "3320",
        ]);


    }

}

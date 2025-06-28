<?php

namespace Database\Seeders;

use App\Models\Media;
use App\Models\Category;
use Illuminate\Database\Seeder;

class RadioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener la categoría Destacable
        $destacableCategory = Category::where('name', 'Destacable')->first();

        $radios = [
            [
                'title' => 'REENCUENTRO SINFÓNICO 10 FEBRERO 2021',
                'description' => "Presentamos la celebrada creación de THEODORO VALCÁRCEL, CONCIERTO INDIO PARA VIOLÍN Y ORQUESTA, interpretado por la Filarmónica de Reutlingen.\nRAÚL GARCÍA ZÁRATE interpreta 'VIRGENES DEL SOL' acompañado por la Orquesta de Cuerdas del maestro Enrique Lynch.\nEL BOLERO de MAURICE RAVEL interpretada por la Philharmonic Wiener\nDe FELIX MENDELSSOHN, CONCIERTO PARA VIOLIN EN MI MENOR interpretado por Isaac Stern.\nDesde la ópera 'OTELO' DE GIUSEPPE VERDI la pieza titulada 'DANZAS' extraída del Acto III interpretado por la Orquesta Sinfónica Nacional de la Radio y Televisión Italiana.",
                'file_url' => 'https://www.youtube.com/watch?v=Ys1rlq2tclE',
            ],
            [
                'title' => 'REENCUENTRO SINFÓNICO 17 FEBRERO 2021',
                'description' => "VIOLETA PARRA, GRACIAS A LA VIDA. Piano Richard Claydermann.\nJOHN WILLIAMS, banda sonora de la película SUPERMAN, STARS WARS Cuarto del Trono-Sección Final. Filarmónica de Berlín.\nGUSTAV MAHLER, SYMPHONY NO. 5 II MOV., Berliner Philharmoniker.\nCAMILLE SAINT-SAËNS, SYMPHONY NO. 3 (FINALE). Filarmónica de Berlin.\nMIJAIL IVANOVICH GLINKA, obertura de la ópera RUSLÁN Y LIUDMILA.\nPIOTR ILICH CHAIKOVSKI, EL LAGO DE LOS CISNES-Escena del Lago y Danza Húngara.\nARCANGELO CORELLI, SARABANDA EN FA MAYOR.\nGIACOMO PUCCINI, ÓPERA 'MADAMA BUTTERFLY' UN BEL DÌ VEDREMO. Maria Callas.\nALFRED NEWMAN, CUMBRES BORRASCOSAS.\nGEORGE GERSHWIN, CONCIERTO PARA PIANO IN F MAJOR III MOV. ALLEGRO AGITATO, director Steuart Bedford English Chamber Orchestra.\n'SAMBA MALATÓ', recreado por NICOMEDES y VICTORIA SANTA CRUZ Y VICENTE VÁSQUEZ.\nJAVIER ECHECOPAR MONGILARDI interpreta LA DANZA DE LAS TIJERAS.\nFRANZ SCHUBERT, SINFONÍA EN SI MENOR, D. 759 LA 'INACABADA'.",
                'file_url' => 'https://www.youtube.com/watch?v=sR2-Gmgi2tE',
            ],
            [
                'title' => 'REENCUENTRO SINFÓNICO 19 FEBRERO 2021',
                'description' => "LUIGI BOCCHERINI, 'MINUETTO'.\nGEORGE FRIEDERICH HAENDEL 'HALLELUJAH', CORO REAL DE LONDRES.\nNIKOLAI RIMSKI-KORZAKOV ÓPERA 'LA CIUDAD INVISIBLE DE KITEGE' -THE BATTLE OF KERZHENETS MARIINSKY ORCHESTRA.\nPERCY GRAINGER, 'MOLLY ON THE SHORE', FILARMÓNICA DE TEXAS.\nTORU TAKEMITSU, Tema central del Film 'DODES'KA DEN'.\nCARL CZERNY, CONCIERTO PARA PIANO A CUATRO MANOS Y ORQUESTA PARTE I.\nKENNETH J. ALFORD, 'COLONEL BOGEY MARCH', banda sonora de la película 'El Puente sobre el Rio Kwai'. Orquesta Andre Rieu.\nFRANCISCO TÀRREGA, 'RECUERDOS DE LA ALHAMBRA', interpretado por ANDRÉS SEGOVIA TORRES.\nJULES MASSENET, 'LA MEDITACIÓN DE THAIS', SINFÓNICA DE LONDRES dirigida por CHARLES GERHARDT.\nEDWARD ELGAR, 'SALU D PRIMACIA' y 'POMPA Y CIRCUNSTANCIA'.\nMICHEL LEGRAND, 'LA VIE EN ROSE', orquesta de André Rieu, luego Andrea Boccelli.\nWOLFGANG AMADEUS MOZART, SINFONÍA PRAGA O LA 'SINFONÍA NRO. 38' I MOVIMIENTO, Orquesta Barroca de Friburgo.\nUn PASILLO, Orquesta Sinfónica de Minería.\nMIGUEL ÁNGEL HURTADO DELGADO, VALICHA, Huayno.",
                'file_url' => 'https://www.youtube.com/watch?v=Fi0Qjm00GV8',
            ],
            [
                'title' => 'REENCUENTRO SINFÓNICO 24 FEBRERO 2021',
                'description' => "FRÉDÉRIC CHOPIN NOCTURNE OP 9, NO 2 IN E FLAT, Arthur Rubinstein.   Luego,\nEL ANDANTE SPIANATO Y GRAN POLONESA OP. 22 Lan Lan. Enseguida, MUSICA POLACA. A continuación, el vals BRILLANTE EN MI BEMOL DEL OPUS 18, Valentina Lisitsa. Acto seguido, LA MAZURCA Nº 3 en FA MAYOR. MAZURKA, Prosigue OP 6 NO 1 Arthur Rubinstein. Sigue, EL CONCIERTO PARA PIANO N.º 1 EN MI MENOR, OP. Finalmente, CONCIERTO PARA PIANO 'NÚMERO 1' IN E MINOR, OP 11, MOV 3 y EL PRELUDIO OP. 28, NÚM. 4. Se cierra con EL CONCIERTO PARA PIANO Y ORQUESTA N.º 2 EN FA MENOR, OP. 21 3ER MOV. QUE ES UN ALLEGRO VIVACE.\nENRICO CARUSO de GIOVANNI CAPURRO Y EDUARDO DI CAPUA, interpreta 'O SOLE MIO', continúa con UNA FURTIVA LACRIMA romanza de la ÓPERA L'ELISIR D'AMORE de GAETANO DONIZETTI. Culmina con 'CARUSO' de LUCIO DALLA.\nROBERT SCHUMANN, OUVERTÜRE, SCHERZO UND FINALE interpretada por la Berliner Philharmoniker.",
                'file_url' => 'https://www.youtube.com/watch?v=nDJYygD00Aw',
            ],
            [
                'title' => 'REENCUENTRO SINFÓNICO 26 FEBRERO 2021',
                'description' => "FREDY MERCURY EL LÍDER DE QUEEN Y, MONSERRAT CABALLÉ LA DIVA COMPUSIERON EN 1988, E INTERPRETARON EN 1992, LA CANCIÓN 'BARCELONA' CANCIÓN OFICIAL DE LOS JUEGOS OLÍMPICOS DE LA CIUDAD ESPAÑOLA.\nLUDWIG VAN BEETHOVENEN, SINFONÍA N.º 8 EN FA MAYOR, OP. 93-I MOV. Enseguida II MOV QUE ES UN ALLEGRETTO. Luego, III MOV. EN TEMPO DI MENUETTO PHILHARMONIKER WIENER DIRIGIDA POR LEONARD BERNSTEIN.\nALEXANDER BORODIN, DANZAS POLOVTSIANAS DE EL PRINCIPE IGOR. Luego,  el 4 MOV Finale en tiempo de ALLEGRO DE LA SINFONÍA N° 2 EN SI MENOR. Enseguida SERENATA A LA ESPAÑOLA.\nGIOACCHINO ROSSINI, OVERTURA ÓPERA EL BARBERO DE SEVILLA. Claudio Abbado. Continúa, la OVERTURE de la ÓPERA SEMIRAMIDE. Sir Simon Rattle. Sigue la ÓPERA GUILLERMO TELL OVERTURE- Filarmónica de Berlin dirigida Leonard Berstein.\nICTUS CUATERTO DE CUERDAS, EL YERBERO, SON DE LA LOMA",
                'file_url' => 'https://www.youtube.com/watch?v=jDJZHjAExKU',
            ],
        ];

        foreach ($radios as $media) {
            // Extraer el ID del video de YouTube
            preg_match('/v=([\w-]+)/', $media['file_url'], $matches);
            $videoId = $matches[1] ?? '';
            $coverImageUrl = $videoId ? "https://img.youtube.com/vi/{$videoId}/hqdefault.jpg" : null;

            Media::create([
                'title' => $media['title'],
                'description' => $media['description'],
                'file_url' => $media['file_url'],
                'type' => 'radio',
                'publication_date' => '2025-06-25',
                'category_id' => $destacableCategory->id,
                'user_id' => 1,
                'tags' => json_encode(['reencuentro', 'pilar-trujillo', 'reencuentro-sinfonico', 'radio', 'destacable']),
                'views_count' => 0,
                'likes_count' => 0,
                'cover_image_url' => $coverImageUrl,
            ]);
        }
    }
}

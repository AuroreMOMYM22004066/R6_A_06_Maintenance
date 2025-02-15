<?php

namespace App\DataFixtures;

use App\Entity\Sport;
use App\Entity\Discipline;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SportDisciplineFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $sportsData = [
            ['id' => 1, 'libelCourt' => 'Licence', 'libelle' => 'Licence'],
            ['id' => 2, 'libelCourt' => 'Cross', 'libelle' => 'Cross Country'],
            ['id' => 3, 'libelCourt' => 'Athlé', 'libelle' => 'Athlétisme en plein air'],
            ['id' => 4, 'libelCourt' => 'Gym', 'libelle' => 'Gymnastique'],
            ['id' => 5, 'libelCourt' => 'Triat', 'libelle' => 'Athlétisme en salle - Benjamins / Minimes'],
            ['id' => 6, 'libelCourt' => 'Chal Spé', 'libelle' => 'Athlétisme en salle - Cadets / Juniors'],
            ['id' => 7, 'libelCourt' => 'Nat Promo', 'libelle' => 'Natation Individuelle - Promotionnel'],
            ['id' => 8, 'libelCourt' => 'Nat', 'libelle' => 'Natation Individuelle'],
            ['id' => 9, 'libelCourt' => 'Quadrat', 'libelle' => 'Athlétisme en plein air - Benjamins / Minimes'],
            ['id' => 10, 'libelCourt' => 'Nat Equ', 'libelle' => 'Natation par équipes'],
            ['id' => 11, 'libelCourt' => 'Bad', 'libelle' => 'Badminton'],
            ['id' => 12, 'libelCourt' => 'TTable', 'libelle' => 'Tennis de Table'],
            ['id' => 13, 'libelCourt' => 'Judo', 'libelle' => 'Judo Elite'],
            ['id' => 14, 'libelCourt' => 'Cycl', 'libelle' => 'Cyclisme'],
            ['id' => 15, 'libelCourt' => 'Vtt', 'libelle' => 'Vélo Tout Terrain'],
            ['id' => 16, 'libelCourt' => 'CO', 'libelle' => 'Course d\'orientation'],
            ['id' => 17, 'libelCourt' => 'Esca', 'libelle' => 'Escalade'],
            ['id' => 18, 'libelCourt' => 'Raid', 'libelle' => 'Raid de pleine nature'],
            ['id' => 19, 'libelCourt' => 'Surf', 'libelle' => 'Surf'],
            ['id' => 20, 'libelCourt' => 'Escri', 'libelle' => 'Escrime'],
            ['id' => 21, 'libelCourt' => 'Combat', 'libelle' => 'Combat au sol Challenge par équipe'],
            ['id' => 22, 'libelCourt' => 'Bad C/J', 'libelle' => 'Badminton simple C/J'],
            ['id' => 23, 'libelCourt' => 'TTable C/J', 'libelle' => 'Tennis de Table simple C/J'],
            ['id' => 24, 'libelCourt' => 'Athlé BM', 'libelle' => 'Athlétisme BM'],
            ['id' => 25, 'libelCourt' => 'Athlé CJ', 'libelle' => 'Athlétisme en plein air - Cadets/Juniors'],
            ['id' => 26, 'libelCourt' => 'Tennis', 'libelle' => 'Tennis'],
        ];

        $disciplinesData = [
            ['sportId' => 3, 'libelle' => 'Vitesse'],
            ['sportId' => 3, 'libelle' => 'Haies'],
            ['sportId' => 3, 'libelle' => 'Distance'],
            ['sportId' => 3, 'libelle' => 'Relais'],
            ['sportId' => 4, 'libelle' => 'Sol'],
            ['sportId' => 4, 'libelle' => 'Saut'],
            ['sportId' => 4, 'libelle' => 'Barres'],
            ['sportId' => 4, 'libelle' => 'Poutre - Barre fixe'],
            ['sportId' => 5, 'libelle' => 'Courses'],
            ['sportId' => 5, 'libelle' => 'Sauts'],
            ['sportId' => 5, 'libelle' => 'Lancers'],
            ['sportId' => 5, 'libelle' => 'Relais'],
            ['sportId' => 6, 'libelle' => 'Vitesse'],
            ['sportId' => 6, 'libelle' => 'Haies'],
            ['sportId' => 6, 'libelle' => 'Distance'],
            ['sportId' => 6, 'libelle' => 'Relais'],
            ['sportId' => 10, 'libelle' => 'Papillon'],
            ['sportId' => 10, 'libelle' => 'Dos'],
            ['sportId' => 10, 'libelle' => 'Brasse'],
            ['sportId' => 10, 'libelle' => 'Libre'],
            ['sportId' => 10, 'libelle' => '4 Nages'],
            ['sportId' => 10, 'libelle' => 'Libre 200'],
            ['sportId' => 10, 'libelle' => 'Rel 4 N'],
            ['sportId' => 10, 'libelle' => 'Rel Libre'],
        ];

        $sports = [];

        // Création des sports
        foreach ($sportsData as $sportInfo) {
            $sport = new Sport();
            $sport->setLibelCourt($sportInfo['libelCourt']);
            $sport->setLibelle($sportInfo['libelle']);
            $manager->persist($sport);

            // Stocker pour les disciplines
            $sports[$sportInfo['id']] = $sport;
        }

        // Création des disciplines associées
        foreach ($disciplinesData as $disciplineInfo) {
            if (isset($sports[$disciplineInfo['sportId']])) {
                $discipline = new Discipline();
                $discipline->setLibelle($disciplineInfo['libelle']);
                $discipline->setSport($sports[$disciplineInfo['sportId']]);
                $manager->persist($discipline);
            }
        }

        $manager->flush();
    }
}

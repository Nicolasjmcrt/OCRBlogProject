-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : jeu. 04 fév. 2021 à 08:39
-- Version du serveur :  5.7.30
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `article_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `intro` varchar(255) NOT NULL,
  `catchphrase` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `update_date` datetime NOT NULL,
  `publication` tinyint(1) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`article_id`, `title`, `intro`, `catchphrase`, `content`, `update_date`, `publication`, `user_id`) VALUES
(1, 'Nouvelles expériences', 'Mondes virtuels : de nouvelles expériences immersives adoptées par les marques', 'L\'heure est à la virtualisation. Découvrez l\'expérience immersive des pop-up spaces imaginée par l\'agence We Are Social.', '<p>La réalité virtuelle est à l’honneur depuis l’apparition de la pandémie : de la sortie du casque Oculus Quest 2 jusqu’à l’émergence de nouveaux mondes virtuels pour tous types de projets. Que ce soit pour de l’événementiel ou à simple but marketing, c’est un véritable nouveau terrain de jeu pour les marques qui doivent proposer des expériences toujours plus innovantes pour toucher leur audience, même à distance.</p>\r\n\r\n<p>Stéphane Maguet, directeur de l’innovation de l’agence créative We Are Social de Paris, aborde avec nous ce sujet tendance qu’est la virtualisation, et nous présente un nouveau projet baptisé pop-up spaces. Ce sont des espaces physiques dupliqués dans le virtuel qui permettent d’interagir avec les autres de façon plus immersive : se plonger dans un monde virtuel avec un casque VR pour se réunir dans une pièce, comme si c’était réel.</p>\r\n\r\n<p><strong>D’où vient l’idée des pop-up spaces ?</strong></p>\r\n\r\n<p>Passionné des mondes virtuels et contraints de télétravailler cette année, le studio d’innovation de We Are Social s’est inspiré d’un prototype imaginé par Greg Madison, un chercheur et designer spécialisé dans les médias immersifs au Unity Labs. Dans la vidéo ci-dessous, on distingue le «&nbsp;digital twin&nbsp;» (jumeau numérique) de son appartement avec lequel il peut interagir. C’est le point de départ de l’idée des pop-up spaces.</p>\r\n\r\n<p><strong>Concrètement, comment ont été conçus ces pop-up spaces ?</strong></p>\r\n\r\n<p>Suite à cette vidéo, Stéphane Maguet a l’idée de créer une version dupliquée de son bureau en réalité virtuelle, et explique :&nbsp;«&nbsp;on décide de prendre les mesures de la pièce et de quelques meubles au millimètre près, avec un télémètre laser. Un de mes designers a ensuite monté les volumes, et nous l’avons injecté dans le casque pour voir ce que cela pouvait donner&nbsp;». Deuxième étape : intégrer ce «&nbsp;bureau augmenté&nbsp;» dans un monde virtuel existant. Le directeur de l’innovation choisit alors de s’appuyer sur Altspace VR, appartenant à Microsoft et injecte l’espace 3D de son bureau dans ce monde.&nbsp; Après mise en place, le pôle innovation démarre ses réunions virtuelles, les membres sont équipés d’un casque et chacun est représenté par un avatar qui répond à ses mouvements.</p>\r\n\r\n<p>Avec les pop-up spaces, il y a le meilleur des deux mondes, de la VR et de l’AR : la puissance d’enchantement de la réalité virtuelle (vision), associée au lieu physique que l’on peut «&nbsp;toucher&nbsp;». Ces espaces peuvent être utilisés par les entreprises tout autant pour des réunions internes que pour des actions auprès de clients.</p>\r\n\r\n<p><strong>Qu’apportent ces espaces virtuels comparés aux visioconférences ?</strong></p>\r\n\r\n<p>Après plusieurs tests en interne, Stéphane Maguet et son équipe se rendent compte que ces espaces virtuels s’avèrent plus efficaces qu’un simple Zoom ou Google Meet. Cette expérience immersive offrirait une meilleure attention et empathie mais aussi un meilleur impact mémoriel.</p>\r\n\r\n<p>Stéphane Maguet a constaté que son équipe avait apprécié de pouvoir se réunir dans un lieu familier, c’est à dire ce bureau physique qui se trouve réellement dans les locaux de l’agence We Are Social :&nbsp;«&nbsp;cela nous a fait énormément de bien de se retrouver dans un lieu qu’on connaissait, cela créé vraiment du lien social.&nbsp;»&nbsp;Ces espaces sont aussi plus favorables à l’avancement des projets collaboratifs comme pour le métier de designer par exemple :&nbsp;«&nbsp;il est difficile de designer à plusieurs sur Zoom surtout pour de la conception détaillée de jeux vidéo ou produits digitaux, mais en VR, cela marche beaucoup mieux car on est plus focus, le rythme des paroles est plus ordonné et il y a plus d’engagement de la part de chacun.&nbsp;»</p>\r\n\r\n<p><strong>Dans quels contextes peuvent être utilisés ces espaces virtuels ?</strong></p>\r\n\r\n<p>Pendant le premier confinement, on a constaté un développement de la virtualisation dans des espaces 3D, notamment pour l’événementiel, pour des festivals comme Burning man ou Laval Virtual ou encore celui de Venise. Les spectateurs peuvent vivre des expériences online à plusieurs dans des mondes 3D. Prochainement, aura lieu le Festival Virtuality, qui propose aux annonceurs de créer leur stand en réalité virtuelle comme vous pouvez le voir dans la vidéo ci-dessous.</p>\r\n\r\n<p>Dans ce contexte de crise et de confinement, le directeur de l’innovation de We Are Social s’est alors posé la questions suivante :&nbsp;«&nbsp;comment redonner le goût de l’espace&nbsp;»&nbsp;? C’est ce qui l’a amené à développer le projet des pop-up spaces dans le but d’enrichir un espace avec une dimension visuelle, narrative, ludique, informationnelle ou interactive.</p>\r\n\r\n<p>Voici des exemples de perspectives d’utilisation d’un pop-up space :</p>\r\n\r\n<ul>\r\n	<li>dans l’immobilier ou l’architecture :&nbsp;permettre sur le lieu physique même, et ce plusieurs mois avant le fin du chantier, d’imaginer concrètement ce que pourra donner la maison ou l’immeuble en construction.</li>\r\n	<li>dans le retail :&nbsp;permettre de créer et d’éditorialiser un espace lors d’une campagne expérientielle pour Noël ou la Saint Valentin.</li>\r\n	<li>dans l’événementiel :&nbsp;permettre de repenser la façon dont est présentée une exposition ou une avant-première, avec la possibilité de connecter un nombre important d’individus sous forme d’avatars.</li>\r\n</ul>\r\n\r\n<p><strong>La virtualisation pourrait-elle être amenée à se démocratiser ?</strong></p>\r\n\r\n<p>On assiste à une émergence forte des plateformes ou des mondes virtuels mais ils ne sont pas complètement démocratisés pour le moment. Le déploiement officiel de la plateforme&nbsp;Facebook Horizon&nbsp;pourrait bien être un tournant dans le domaine de la réalité virtuelle (disponible seulement en version bêta pour le moment). Facebook sera un des premiers acteurs à réunir le hardware et le software, avec un bassin d’audience très large, donnant au grand public un accès facilité à un monde virtuel. Stéphane Maguet aborde aussi le développement des plateformes de gaming telles que Fortnite qui s’ouvrent à de nouveaux horizons tels que la diffusion d’émissions ou de concerts.</p>\r\n\r\n<p>Il explique que les mondes virtuels peuvent devenir de véritables «&nbsp;content factories&nbsp;» pour les marques pour créer des rendez-vous avec leurs communautés. Il précise à ce sujet :&nbsp;«&nbsp;monde virtuel ne veut pas forcément dire réalité virtuelle&nbsp;». C’est à dire que même si peu de personnes possèdent actuellement un casque VR, ces nouveaux mondes virtuels peuvent se développer et être accessibles sans casque au grand public dans une «&nbsp;logique de stream&nbsp;».</p>\r\n\r\n<p>Si Facebook a racheté le casque Oculus VR en 2014, ce n’était pas un hasard, le réseau social avait déjà une stratégie bien avancée sur le sujet, comparée aux autres géants de la tech. La pandémie actuelle pourrait bien lui donner raison, en favorisant l’accélération de la démocratisation des espaces virtuels. Stéphane Maguet, spécialiste du design d’interaction sur le social et le digital imagine quant à lui «&nbsp;les&nbsp;médias immersifs comme le futur des réseaux sociaux&nbsp;».</p>\r\n', '2021-01-04 13:49:24', 1, 5),
(4, 'Zoom se modernise', 'Zoom pourrait bientôt proposer un service d’email et de calendrier', 'Avec la sérieuse augmentation de son utilisation suite au télétravail, Zoom aimerait proposer de nouvelles fonctionnalités.', '<p>Zoom fait parti de ceux pour qui le confinement aura été bénéfique. Que ce soit pour des réunions professionnelles ou pour rester en contact avec ses proches,&nbsp;Zoom&nbsp;a su trouver son public. Et pour maintenir le cap, l’entreprise pourrait bien proposer de nouvelles fonctionnalités : l’email et le calendrier.</p>\r\n\r\n<p><strong>Un service d’email et un calendrier intégrés à la plateforme</strong></p>\r\n\r\n<p>Parce que le télétravail ne durera pas infiniment, Zoom cherche à devenir plus qu’un simple outil de visioconférence, en proposant une plateforme multi-usages. Ainsi, l’entreprise aurait pour projet d’ajouter un service d’email intégré à l’outil, disponible sur le web directement. Ce nouveau service serait actuellement en phase de développement et pourrait commencé à être testé dès 2021. En revanche, la seconde fonctionnalité envisagée serait prévue pour bien plus tard. Il s’agirait d’un service de calendrier intégré.</p>\r\n\r\n<p>Si Zoom souhaite étendre ses fonctionnalités, c’est également pour concurrencer les autres géants du secteur. Des acteurs comme Microsoft avec Office 365 ou Google avec Workspace, qui proposent des plateformes multiservices avec la mise à disposition d’outils de visioconférence, d’email et de calendrier. Les nouvelles fonctionnalités que souhaiterait intégrer Zoom répondraient donc à cet objectif.</p>\r\n\r\n<p>En clair, il faudra encore attendre un certain temps avant de pouvoir bénéficier de ces nouvelles fonctionnalités. Néanmoins, vous pourrez tout de même profiter pleinement de la plateforme durant les fêtes de fin d’année car pour l’occasion, Zoom a enlevé la limite des 40 minutes de visioconférence sur les comptes gratuits !</p>\r\n<p>Zoom fait parti de ceux pour qui le confinement aura été bénéfique. Que ce soit pour des réunions professionnelles ou pour rester en contact avec ses proches,&nbsp;Zoom&nbsp;a su trouver son public. Et pour maintenir le cap, l’entreprise pourrait bien proposer de nouvelles fonctionnalités : l’email et le calendrier.</p>\r\n\r\n<p><strong>Un service d’email et un calendrier intégrés à la plateforme</strong></p>\r\n\r\n<p>Parce que le télétravail ne durera pas infiniment, Zoom cherche à devenir plus qu’un simple outil de visioconférence, en proposant une plateforme multi-usages. Ainsi, l’entreprise aurait pour projet d’ajouter un service d’email intégré à l’outil, disponible sur le web directement. Ce nouveau service serait actuellement en phase de développement et pourrait commencé à être testé dès 2021. En revanche, la seconde fonctionnalité envisagée serait prévue pour bien plus tard. Il s’agirait d’un service de calendrier intégré.</p>\r\n\r\n<p>Si Zoom souhaite étendre ses fonctionnalités, c’est également pour concurrencer les autres géants du secteur. Des acteurs comme Microsoft avec Office 365 ou Google avec Workspace, qui proposent des plateformes multiservices avec la mise à disposition d’outils de visioconférence, d’email et de calendrier. Les nouvelles fonctionnalités que souhaiterait intégrer Zoom répondraient donc à cet objectif.</p>\r\n\r\n<p>En clair, il faudra encore attendre un certain temps avant de pouvoir bénéficier de ces nouvelles fonctionnalités. Néanmoins, vous pourrez tout de même profiter pleinement de la plateforme durant les fêtes de fin d’année car pour l’occasion, Zoom a enlevé la limite des 40 minutes de visioconférence sur les comptes gratuits !</p>\r\n', '2020-12-24 14:45:44', 1, 1),
(6, 'Snapchat lance spotlight', 'Snapchat lance Spotlight pour concurrencer TikTok et donne 1 million de dollars par jour aux créateurs', 'Avec cette nouvelle fonctionnalité, Snapchat souhaite attirer de nouveaux influenceurs et faire de l’ombre à son principal concurrent TikTok.', '<p>Spotlight est un nouvel espace créé au sein de l’application Snapchat, ouvert à tous, qui permet de rassembler les meilleurs contenus générés par les utilisateurs du réseau social. Tous les Snaps les plus amusants et les plus populaires réalisés par la communauté sont réunis au même endroit, en fonction d’un algorithme basé sur les préférences de chacun. Snapchat s’inspire de la fonctionnalité qui a fait le succès de son principal concurrent, TikTok, et repris récemment par Instagram avec ses Reels.</p>\r\n\r\n<p><em>Les Snapchatters sont parmi les conteurs mobiles les plus expressifs et les plus créatifs du monde et Spotlight leur donne l’occasion de partager plus largement leurs créations. Avec plus de 4 milliards de Snaps créés chaque jour, Spotlight permet à la communauté Snapchat de s’exprimer et de toucher un large public d’une nouvelle manière, explique Snapchat dans un communiqué.</em></p>\r\n\r\n<p>Le réseau social précise que les contenus diffusés sur Spotlight sont modérés et ne sont pas ouverts aux commentaires publics, à la différence de TikTok. Les utilisateurs ont ainsi la possibilité de soumettre leurs créations et consulter celles partagées par le reste de la communauté.</p>\r\n\r\n<p><strong>Des contenus créatifs récompensés à hauteur d’1 million de dollar par jour</strong></p>\r\n\r\n<p>Pour proposer du contenu à valeur ajoutée de la part de sa communauté, Snapchat invite ses utilisateurs à envoyer leurs meilleures vidéos sur Spotlight. Le réseau social s’engage à verser plus d’un million de dollars par jour, jusqu’à la fin de l’année 2020, aux Snapchatters qui auront partagé leurs créations les plus virales. Pour participer au concours, il faut être âgé d’au moins 16 ans et, le cas échéant, obtenir l’autorisation de ses parents. On vous explique tout dans ce tuto (conseils, astuces, conditions…) :</p>\r\n\r\n<p><strong>Une nouvelle fonctionnalité pour s’imposer face à la concurrence de TikTok</strong></p>\r\n\r\n<p>Avec 689 millions d’utilisateurs mensuels, TikTok s’est imposé en peu de temps sur la cible privilégiée de Snapchat. Si ce dernier reste néanmoins&nbsp;l’application préférée des adolescents américains, devant TikTok et Instagram, Snapchat doit encore se renouveler et proposer de nouvelles fonctionnalités à ses utilisateurs. Avec Spotlight, Snapchat vise à attirer de nouveaux influenceurs, notamment parmi ceux qui ont investi son concurrent TikTok, en échange d’une compensation financière. En juin dernier, TikTok avait proposé un programme de parrainage avec un système d’étoiles permettant de récolter de l’argent pour augmenter sa base d’utilisateurs. Reste à savoir si cette nouvelle fonctionnalité permettra à Snapchat de récupérer des parts de marché.</p>\r\n\r\n<p>Spotlight est disponible dès maintenant dans de nombreux pays&nbsp;: États-Unis, Canada, Australie, Nouvelle-Zélande, Royaume-Uni, Irlande, Norvège, Suède, Danemark, Allemagne et France. La nouvelle fonctionnalité de Snapchat sera déployée dans d’autres pays dans les semaines à venir.</p>\r\n', '2020-11-24 18:48:16', 1, 1),
(7, 'Le SEO en 8 étapes', '8 étapes pour optimiser le temps de chargement de son site web', 'La vitesse de votre site web et l\'expérience utilisateur seront pris en compte par Google en mai 2021. Voici 8 étapes pour optimiser vos pages web.', '<p>Google a officialisé l’intégration des critères de performance web dans ses algorithmes. En mai 2021,&nbsp;la mise à jour Page Experience&nbsp;sera appliquée et les Core web vitals seront utilisés pour classer les pages web. Voici quelques étapes à suivre pour optimiser son site web et obtenir de bons résultats SEO au printemps prochain.</p>\r\n\r\n<p><strong>1. Utiliser la Search Console pour faire un audit Core web vitals</strong></p>\r\n\r\n<p>Pour commencer, regardez ce que pense Google de votre site.&nbsp;Sur la Search Console, l’outil gratuit de Google pour&nbsp;«&nbsp;mesurer les performances et le trafic de recherche de votre site, résoudre les problèmes et optimiser le classement dans les résultats de recherche&nbsp;», une partie du menu latéral est dédiée aux Améliorations. Cliquez sur&nbsp;Signaux web essentiels&nbsp;pour accéder aux informations liées à la vitesse de votre site.</p>\r\n\r\n<p>Vous visualisez alors la vitesse de chargement globale de votre site :</p>\r\n\r\n<ul>\r\n	<li>le nombre de pages web rapides selon Google</li>\r\n	<li>le nombre de pages à améliorer</li>\r\n	<li>le nombre de pages lentes</li>\r\n	<li>sur mobile et sur ordinateur</li>\r\n</ul>\r\n\r\n<p>Cela donne un bon aperçu du temps de chargement, à la fois pour Google et pour les internautes, car Google se base sur le rapport d’expérience utilisateur Chrome (CrUX).</p>\r\n\r\n<p><strong>2. Visualiser les problèmes de chargement de son site web</strong></p>\r\n\r\n<p>La Search Console va plus loin : en cliquant sur Ouvrir le rapport (mobile ou ordinateur), vous obtenez des informations précieuses sur les problèmes repérés par Google. Certaines actions que vous réaliserez pourront avoir un impact à la fois sur le mobile et sur le desktop. Il est plutôt conseillé de commencer par régler les problèmes sur mobile, étant donné que l’indexation mobile-first est appliquée à la plupart des sites – et sera bientôt la règle pour l’ensemble des sites internet (c’était initialement prévu pour l’automne 2020, cela a été repoussé au printemps 2021). Pensez également à régler les problèmes rencontrés sur PC si votre audience desktop représente une part importante, si le nombre de pages affectées est grand ou si les problèmes soulevés sont majeurs.</p>\r\n\r\n<p>Ci-dessus, on voit 3 problèmes identifiés par Google.</p>\r\n\r\n<ul>\r\n	<li>un CLS supérieur à 0,25 sur mobile pour 80 pages,</li>\r\n	<li>un CLS qui dépasse 0,1 pour près de 8 000 pages</li>\r\n	<li>un LCP supérieur à 2,5 secondes sur mobile pour 298 pages</li>\r\n</ul>\r\n\r\n<p>Cela signifie que l’utilisateur subit des décalages de l’interface lors du chargement de la page, une expérience peu appréciée par Google. Le LCP désigne quant à lui le temps de chargement de l’élément principal de la page.</p>\r\n\r\n<p><strong>3. Identifier les pages web lentes et à améliorer</strong></p>\r\n\r\n<p>En cliquant sur un problème, on accède à un rapport très riche en enseignements.</p>\r\n\r\n<p>Sur l’interface ci-dessus, on se concentre sur un problème : un CLS supérieur à 0,25 sur mobile. Google regroupe automatiquement les pages web concernées, leur attribue un CLS agrégé (0,37, cet indice correspondant au CLS le plus faible pour 75 % des visites d’une URL du groupe) et montre des URL similaires, à droite. Cette étape est très importante car elle permet de comprendre les templates de page qui posent problème. On regrettera simplement le fait que Google semble se baser sur les structures d’URL pour agréger les pages et ne soit pas en mesure d’isoler des constructions de pages distinctes lorsque ces pages partagent la même structure d’URL.</p>\r\n\r\n<p><strong>4. Tester les pages web concernées avec PageSpeed Insights</strong></p>\r\n\r\n<p>À droite de l’écran, vous pouvez tester une URL du groupe avec&nbsp;PageSpeed Insights. Cet outil conçu par Google permet d’effectuer un audit précis de la performance web. L’exemple ci-dessous montre le rapport obtenu pour une page web qui ne passe pas le test d’évaluation. Si le Cumulative Layout Shift (CLS) et le First Input Delay (FID) sont dans le vert, le Largest Contentful Paint est à améliorer. PageSpeed Insights montre également que le First Contentful Paint (FCP) mériterait d’être révisé.</p>\r\n\r\n<p><strong>5. Repérer les problèmes à corriger pour accélérer ses pages web</strong></p>\r\n\r\n<p>D’autres données sont communiquées par PSI, donc des données de laboratoire obtenues par&nbsp;Lighthouse&nbsp;permettant de calculer le score de vitesse global. Et surtout : on accède à une liste d’opportunités, «&nbsp;des suggestions [qui] peuvent contribuer à charger votre page plus rapidement&nbsp;». Cliquez sur chaque opportunité pour obtenir des conseils dédiés à l’optimisation des points de friction repérés par Google.</p>\r\n\r\n<p><strong>6. Valider les corrections et vérifier l’amélioration des signaux web essentiels</strong></p>\r\n\r\n<p>Le workflow proposé par Google, de la Search Console à Page Speed Insights, permet de repérer et régler de nombreux problèmes de performance web. En vous concentrant sur les éléments remontés par ces outils Google, vous devriez rapidement voir vos KPI Core web vitals s’améliorer sur Search Console. Vous serez prêt pour mai 2021 !</p>\r\n\r\n<p>Vous pouvez indiquer à Google qu’un problème a été corrigé en retournant sur Search Console et en cliquant sur Valider la correction. Les robots Google iront alors vérifier que les éléments ont bien été améliorés. Cette étape n’est pas obligatoire, car Google passe régulièrement sur votre site. Mais cela peut permettre d’accélérer le process en indiquant aux robots qu’ils peuvent vérifier ces éléments sur les pages concernées.</p>\r\n\r\n<p><strong>7. Utiliser d’autres outils pour identifier les problèmes de performance web</strong></p>\r\n\r\n<p>Si Page Speed Insights permet d’identifier de nombreux problèmes de chargement sur vos pages web, d’autres outils peuvent être utilisés. Vous pouvez par exemple vous baser sur les rapports de&nbsp;GTmetrix. Bonne nouvelle :&nbsp;ce service utilise désormais Lighthouse&nbsp;pour mesurer la vitesse des pages web et conserve une vraie valeur ajoutée, notamment via l’onglet Structure qui fournit des conseils précis aux développeurs. Les problèmes sont classés par impact pour faciliter la priorisation des actions à mener. Mauvaise nouvelle : le pricing vient d’être modifié et le plan gratuit est plus limité que par le passé.</p>\r\n\r\n<p><strong>8. Monitorer la performance web de son site en temps réel</strong></p>\r\n\r\n<p>Une fois ces problèmes réglés, n’oubliez pas que votre score peut évoluer : vous pouvez décider de faire évoluer le template d’une page web, ajouter des images ou des vidéos, changer de serveur ou utiliser d’autres méthodes pour mettre en cache les ressources. Toutes les modifications apportées à votre site pourront avoir un impact sur les signaux de performance web observés par Google. Il est également possible que votre site intègre des ressources externes. Il est donc conseillé d’utiliser un outil permettant de monitorer en continu la performance de vos pages web ; nous avons déjà cité GTmetrix, il existe également d’autres services intéressants comme&nbsp;Dareboost.</p>\r\n\r\n<p>Aussi, n’oubliez pas que vous pouvez tester la performance web de vos pages en pré-production via Google Chrome (clic droit, Inspecter, onglet Lighthouse). Vous pourrez ainsi repérer si de nouveaux éléments risquent de dégrader votre score et donc, à partir de mai 2021, le référencement de vos pages web. La performance web étant en passe de devenir un critère SEO pour Google, elle devrait également constituer un élément scruté de près par les équipes de développement à toutes les étapes de la conception.</p>\r\n', '2020-11-20 18:54:21', 1, 1),
(8, 'Création du Blog CoyoTech', 'Découvrons ensemble le pourquoi du comment de ce Blog...', 'Ce Blog est en fait le projet 5 de ma formation Développeur d\'Applications PHP/Symfony', '<p>Cet article va vous permettre d\'en savoir plus sur le contexte ainsi que les impératifs de la conception de ce Blog.</p>\r\n\r\n<p><strong>Contexte</strong></p>\r\n\r\n<p>Ça y est, vous avez sauté le pas ! Le monde du développement web avec PHP est à portée de main et vous avez besoin de visibilité pour pouvoir convaincre vos futurs employeurs/clients en un seul regard. Vous êtes développeur PHP, il est donc temps de montrer vos talents au travers d’un blog à vos couleurs.</p>\r\n\r\n<p><strong>Description du besoin</strong></p>\r\n\r\n<p>Le projet est donc de développer votre blog professionnel. Ce site web se décompose en deux grands groupes de pages :</p>\r\n\r\n<ul>\r\n	<li>les pages utiles à tous les visiteurs ;</li>\r\n	<li>les pages permettant d’administrer votre blog.</li>\r\n</ul>\r\n\r\n<p>Voici la liste des pages qui devront être accessibles depuis votre site web :</p>\r\n\r\n<ul>\r\n	<li>la page d\'accueil ;</li>\r\n	<li>la page listant l’ensemble des blog posts ;</li>\r\n	<li>la page affichant un blog post ;</li>\r\n	<li>la page permettant d’ajouter un blog post ;</li>\r\n	<li>la page permettant de modifier un blog post ;</li>\r\n	<li>les pages permettant de modifier/supprimer un blog post ;</li>\r\n	<li>les pages de connexion/enregistrement des utilisateurs.</li>\r\n</ul>\r\n\r\n<p>Vous développerez une partie administration qui devra être accessible uniquement aux utilisateurs inscrits et validés.</p>\r\n\r\n<p>Les pages d’administration seront donc accessibles sur conditions et vous veillerez à la sécurité de la partie administration.</p>\r\n\r\n<p>Commençons par les pages utiles à tous les internautes.</p>\r\n\r\n<p>Sur la page d’accueil, il faudra présenter les informations suivantes :</p>\r\n\r\n<ul>\r\n	<li>votre nom et votre prénom ;</li>\r\n	<li>une photo et/ou un logo ;</li>\r\n	<li>une phrase d’accroche qui vous ressemble (exemple : “Martin Durand, le développeur qu’il vous faut !”) ;</li>\r\n	<li>un menu permettant de naviguer parmi l’ensemble des pages de votre site web ;</li>\r\n	<li>un formulaire de contact (à la soumission de ce formulaire, un e-mail avec toutes ces informations vous sera envoyé) avec les champs suivants :</li>\r\n</ul>\r\n\r\n<ol>\r\n	<li>nom/prénom,</li>\r\n	<li>e-mail de contact,</li>\r\n	<li>message,</li>\r\n</ol>\r\n\r\n<ul>\r\n	<li>un lien vers votre CV au format PDF ;</li>\r\n	<li>et l’ensemble des liens vers les réseaux sociaux où l’on peut vous suivre (GitHub, LinkedIn, Twitter…).</li>\r\n</ul>\r\n\r\n<p>Sur la page listant tous les blogs posts (du plus récent au plus ancien), il faut afficher les informations suivantes pour chaque blog post :</p>\r\n\r\n<ul>\r\n	<li>le titre ;</li>\r\n	<li>la date de dernière modification ;</li>\r\n	<li>le châpo ;</li>\r\n	<li>et un lien vers le blog post.</li>\r\n</ul>\r\n\r\n<p>Sur la page présentant le détail d’un blog post, il faut afficher les informations suivantes :</p>\r\n\r\n<ul>\r\n	<li>le titre ;</li>\r\n	<li>le chapô ;</li>\r\n	<li>le contenu ;</li>\r\n	<li>l’auteur ;</li>\r\n	<li>la date de dernière mise à jour ;</li>\r\n	<li>le formulaire permettant d’ajouter un commentaire (soumis pour validation) ;</li>\r\n	<li>les listes des commentaires validés et publiés.</li>\r\n</ul>\r\n\r\n<p>Sur la page permettant de modifier un blog post, l’utilisateur a la possibilité de modifier les champs titre, chapô, auteur et contenu.</p>\r\n\r\n<p>Dans le footer menu, il doit figurer un lien pour accéder à l’administration du blog.</p>\r\n\r\n<p><strong>Contraintes</strong></p>\r\n\r\n<p>Cette fois-ci, nous n’utiliserons pas WordPress. Tout sera développé par vos soins. Les seules lignes de code qui pourront provenir d’ailleurs seront celles du thème Bootstrap, que vous prendrez grand soin de choisir. La présentation, ça compte ! Il est également autorisé d’utiliser une ou plusieurs librairies externes à condition qu’elles soient intégrées grâce à&nbsp;Composer.</p>\r\n\r\n<p>Attention, votre blog doit être navigable aisément sur un mobile (téléphone mobile, phablette, tablette…). C’est indispensable ! C’est indispensable&nbsp;</p>\r\n\r\n<p>Nous vous conseillons vivement d’utiliser un moteur de templating tel que Twig, mais ce n’est pas obligatoire.</p>\r\n\r\n<p>Sur la partie administration, vous veillerez à ce que seules les personnes ayant le droit “administrateur” aient l’accès ; les autres utilisateurs pourront uniquement commenter les articles (avec validation avant publication).</p>\r\n\r\n<p><strong>Important</strong> :&nbsp;Vous vous assurerez qu’il n’y a pas de failles de sécurité (XSS, CSRF, SQL Injection, session hijacking, upload possible de script PHP…).</p>\r\n\r\n<p>Votre projet doit être poussé et disponible sur GitHub. Je vous conseille de travailler avec des pull requests. Dans la mesure où la majorité des communications concernant les projets sur GitHub se font en anglais, il faut que vos commits soient en anglais.</p>\r\n\r\n<p>Vous devrez créer l’ensemble des issues (tickets) correspondant aux tâches que vous aurez à effectuer pour mener à bien le projet.</p>\r\n\r\n<p>Veillez à bien valider vos tickets pour vous assurer que ceux-ci couvrent bien toutes les demandes du projet. Donnez une estimation indicative en temps ou en points d’effort (si la méthodologie agile vous est familière) et tentez de tenir cette estimation.</p>\r\n\r\n<p>L’écriture de ces tickets vous permettra de vous accorder sur un vocabulaire commun. Il est fortement apprécié qu’ils soient écrits en anglais !</p>\r\n\r\n<p><strong>Nota Bene</strong></p>\r\n\r\n<p>Votre projet devra être suivi via&nbsp;SymfonyInsight, ou&nbsp;Codacy&nbsp;pour la qualité du code. Vous veillerez à obtenir une médaille d\'argent au minimum (pour SymfonyInsight). En complément, le respect des PSR est recommandé afin de proposer un code compréhensible et facilement évolutif.</p>\r\n\r\n<p>Si vous n’arrivez pas à vous décider sur le thème Bootstrap, en voici un qui pourrait vous convenir&nbsp;http://bit.ly/2emOTxY&nbsp;(source : startbootstrap.com).</p>\r\n\r\n<p>Dans le cas où une fonctionnalité vous semblerait mal expliquée ou manquante, parlez-en avec votre mentor afin de prendre une décision ensemble concernant les choix que vous souhaiteriez faire. Ce qui doit prévaloir doit être les délais.</p>\r\n\r\n<p><strong>De l\'aide pour aborder le projet étape par étape</strong></p>\r\n\r\n<p>Afin de fluidifier votre avancement voici une proposition de manière de travailler :</p>\r\n\r\n<ul>\r\n	<li>Étape 1&nbsp;- Prenez connaissance entièrement de l’énoncé et des spécifications détaillées.</li>\r\n	<li>Étape 2&nbsp;- Créez les diagrammes UML.</li>\r\n	<li>Étape 3&nbsp;- Créez le repository GitHub pour le projet.</li>\r\n	<li>Étape 4&nbsp;- Créez l’ensemble des issues sur le repository GitHub.</li>\r\n	<li>Étape 5&nbsp;- Faites les estimations de l’ensemble de vos issues.</li>\r\n	<li>Étape 6&nbsp;- Entamez le développement de l’application et proposez des pull requests pour chacune des fonctionnalités/issues. (L’estimation se fera au fur et à mesure de votre développement et sera discutée avec votre mentor.)</li>\r\n	<li>Étape 7&nbsp;- Faites relire votre code à votre mentor (code proposé dans la ou les pull requests), et une fois validée(s) mergez la ou les pull requests dans la branche principale. (Cette relecture servira à valider votre implémentation des bonnes pratiques et la cohérence de votre code. La validation se fera en continu durant les sessions.)</li>\r\n	<li>Étape 8&nbsp;- Validez la qualité du code via SymfonyInsight ou Codacy.</li>\r\n	<li>Étape 9&nbsp;- Effectuez une démonstration de l’ensemble de l’application.</li>\r\n	<li>Étape 10&nbsp;- Préparez l’ensemble de vos livrables et soumettez-les sur la plateforme.</li>\r\n</ul>\r\n\r\n<p><br />\r\nPrenez le temps de valider chaque étape avec votre mentor afin de vous assurer que vous avancez dans la bonne direction&nbsp;</p>\r\n\r\n<p><strong>Livrables</strong></p>\r\n\r\n<ul>\r\n	<li>Un lien vers l’ensemble du projet (fichiers PHP/HTML/JS/CSS…) sur un repository GitHub</li>\r\n	<li>Les instructions pour installer le projet (dans un fichier README à la racine du projet)</li>\r\n	<li>Les schémas UML (au format PNG ou JPG dans un dossier nommé “diagrammes” à la racine du projet)</li>\r\n</ul>\r\n\r\n<ol>\r\n	<li>&nbsp;diagrammes de cas d’utilisation</li>\r\n	<li>diagramme de classes</li>\r\n	<li>&nbsp;diagrammes de séquence</li>\r\n</ol>\r\n\r\n<ul>\r\n	<li>Les issues sur le repository GitHub que vous aurez créé</li>\r\n	<li>Un lien vers la dernière analyse SymfonyInsight ou Codacy (ou vers le projet public sur la plateforme)</li>\r\n</ul>\r\n\r\n\r\n<p><strong>Conclusion</strong></p>\r\n\r\n<p>Je compte créer très prochainement une catégorie \"Projets\" dans laquelle seront regroupées toutes mes créations, présentes et à venir, qu\'elles soient personnelles ou conçues dans le cadre de mes parcours de formation.<br />Restez à l\'affut !</p>\r\n', '2021-01-19 11:11:36', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(10) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `comment_date` datetime NOT NULL,
  `validation` tinyint(1) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `article_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`comment_id`, `content`, `comment_date`, `validation`, `user_id`, `article_id`) VALUES
(1, 'Le premier d\'une longue série j\'espère !', '2021-01-04 12:07:53', 1, 7, 1),
(3, 'Pourvu que ça dure !', '2021-01-04 14:04:02', 1, 6, 1),
(4, 'Un autre pour voir !', '2021-01-21 10:19:18', 1, 6, 1),
(5, 'Test pour voir si ça marche', '2021-01-21 14:52:04', 1, 7, 8),
(6, 'Et un autre !', '2021-01-21 14:53:01', 1, 6, 8),
(7, 'Hello tout le monde ! Comment ça va ?', '2021-01-28 16:09:38', 1, 6, 4),
(11, 'Un plus long commentaire pour voir comment ça s\'affiche dans le tableau des commentaires en attente de validation...', '2021-02-02 17:26:25', 1, 7, 7);

-- --------------------------------------------------------

--
-- Structure de la table `media`
--

CREATE TABLE `media` (
  `media_id` int(10) UNSIGNED NOT NULL,
  `caption` varchar(255) NOT NULL,
  `file_name` varchar(50) NOT NULL,
  `extension` varchar(5) NOT NULL,
  `size` int(11) NOT NULL,
  `article_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `nickname` varchar(255) DEFAULT NULL,
  `login` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `active_account` tinyint(1) NOT NULL,
  `role` enum('Administrator','Author','Visitor') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `nickname`, `login`, `email`, `password`, `active_account`, `role`) VALUES
(1, 'Nicolas', 'Jumeaucourt', '', 'contact@coyotech.fr', 'contact@coyotech.fr', '$2y$10$h4684TEgwKRpLn2G6GmbJu5NKOP1y0Op3aUZ0pkElM4nwWJmAHGh6', 1, 'Administrator'),
(5, 'Barbara', 'Garnier', '', 'garnierbarbara@dbmail.com', 'garnierbarbara@dbmail.com', '$2y$10$0HqZ/dl4TrOKeKwGZFPaW.u.LF4UxdjWztVFOYFcaUAlTn2nUdh9.', 1, 'Administrator'),
(6, 'Victor', 'Jumeaucourt', 'Rotciv', 'jumeaucourtv@gmail.com', 'jumeaucourtv@gmail.com', '$2y$10$dgK6BBiXuUg7ZUF1qDFMnefptVPJ1Y.thBb..eUjPcHr.WsRofOhi', 1, 'Visitor'),
(7, 'Maxime', 'Jumeaucourt', 'Max0u', 'jumeaucourtmx@gmail.com', 'jumeaucourtmx@gmail.com', '$2y$10$sw8swl.Wz6SrdVCyJ5VBmuxwiTnEfZiYE2kBB7UQjsvYB/toM75eS', 1, 'Visitor');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`article_id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `fk_article_id` (`article_id`),
  ADD KEY `fk_user_coment_it` (`user_id`);

--
-- Index pour la table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`media_id`),
  ADD KEY `fk_media_article_id` (`article_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `article_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `media`
--
ALTER TABLE `media`
  MODIFY `media_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_article_id` FOREIGN KEY (`article_id`) REFERENCES `article` (`article_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_coment_it` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `fk_media_article_id` FOREIGN KEY (`article_id`) REFERENCES `article` (`article_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

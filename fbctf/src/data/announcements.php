<?hh // strict

require_once ($_SERVER['DOCUMENT_ROOT'].'/../vendor/autoload.php');

class AnnouncementsDataController extends DataController {
  public async function genGenerateData(): Awaitable<void> {

    /* HH_IGNORE_ERROR[1002] */
    SessionUtils::sessionStart();
    SessionUtils::enforceLogin();

    $data = array();

    $all_announcements = await Announcement::genAllAnnouncements();
    foreach ($all_announcements as $announcement) {
      array_push($data, $announcement->getAnnouncement());
    }

    $this->jsonSend($data);
  }
}

/* HH_IGNORE_ERROR[1002] */
$announcementsData = new AnnouncementsDataController();
$announcementsData->sendData();

<?php
/**
 *
 **/
namespace Edu\Cnm\Infrastructure;

require_once ("autoload.php");

use Ramsey\Uuid\Uuid;
/**
 * Class Report
 * @author Kevin D. Atkins
 **/
class Report implements \JsonSerializable {
	use ValidateUuid;
	use ValidateDate;
	/**
	 * id for this report; primary key
	 * @var $reportId
	 **/
	private $reportId;
	/**
	 * id  for this report category; foreign key
	 * @var $reportCategoryId
	 **/
	private $reportCategoryId;
	/**
	 * content of this report
	 * @var $reportContent
	 **/
	private $reportContent;
	/**
	 * date and time for this report
	 * @var $reportDateTime
	 **/
	private $reportDateTime;
	/**
	 * ip address to report
	 * @var $reportIpAddress
	 **/
	private $reportIpAddress;
	/**
	 * latitide for report
	 * @var $reportLat;
	 **/
	private $reportLat;
	/**
	 * longitude for report
	 * @var $reportLong
	 **/
	private $reportLong;
	/**
	 * status for report
	 * @var $reportStatus
	 **/
	private $reportStatus;
	/**
	 * urgency for this report
	 * @var $reportUrgency
	 **/
	private $reportUrgency;
	/**
	 * user agent for report
	 * @var $reportUserAgent
	 **/
	private $reportUserAgent;

	public function __construct($newReportId, $newReportCategoryId, string $newReportContent, $newReportDateTime = null,
										 $newReportIpAddress, $newReportLat, $newReportLong, $newReportStatus, $newReportUrgency,
										 $newReportUserAgency) {
		try {
			$this->setReportId($newReportId);
			$this->setReportCategoryId($newReportCategoryId);
			$this->setReportContent($newReportContent);
			$this->setReportDateTime($newReportDateTime);
			$this->setReportIpAddress($newReportIpAddress);
			$this->setReportLat($newReportLat);
			$this->setReportLong($newReportLong);
			$this->setReportStatus($newReportStatus);
			$this->setReportUrgency($newReportUrgency);
			$this->setReportUserAgency($newReportUserAgency);

		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * accessor method for report id
	 *
	 * @return Uuid value of report id
	 **/
	public function getReportId() : Uuid {
		return($this->reportId);
	}

	/**
	 * mutator method for report id
	 *
	 * @param Uuid/string $newReportId new value of report id
	 *
	 * @throws \RangeException if $newReportId is not positive
	 *
	 * @throws \TypeError if $newReportId is not a uuid or string
	 **/
	public function setReportId($newReportId) : void {
		try {
			$uuid = self::validateUuid($newReportId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		$this->reportId = $newReportId;
	}

	/**
	 * accessor method for report category id
	 *
	 * @return Uuid value of report category id
	 **/
	public function getReportCategoryId() : Uuid {
		return($this->reportCategoryId);
	}

	/**
	 * mutator method for report category id
	 *
	 * @param Uuid/string $newReportCategoryId new value of report category id
	 * @throws \RangeException if $newReportId is not positive
	 * @throws \TypeError if $newReportCategoryId is not an integer
	 **/
	public function setReportCategoryId($newReportCategoryId) : Uuid {
		$this->reportCategoryId = $newReportCategoryId;
	}
	/**
	 * accessor method for report content
	 *
	 * @return string value of report content
	 **/
	public function getReportContent() : string {
		return($this->reportContent);
	}

	/**
	 * accessor method for report date/time
	 *
	 * @return \DateTime value of report date/time
	 **/
	public function getReportDateTime() : \DateTime {
		return($this->reportDateTime);
	}

	/**
	 * accessor method for report ip address
	 *
	 * @return int value of report ip address
	 **/
	public function getReportIpAddress() : int {
		return($this->reportIpAddress);
	}

	/**
	 * accessor method for report latitude
	 *
	 * @return int value of report latitude
	 **/
	public function getReportLat() : int {
		return($this->reportLat);
	}

	/**
	 * accessor method for report longitude
	 *
	 * @return int value of report longitude
	 **/
	public function getReportLong() : int {
		return($this->reportLong);
	}

	/**
	 * accessor method for report status
	 *
	 * @return string value of report status
	 **/
	public function getReportStatus() : string {
		return($this->reportStatus);
	}

	/**
	 * accessor method for report urgency
	 *
	 * @return string value of report urgency
	 **/
	public function getReportUrgency() : string {
		return($this->reportUrgency);
	}

	/**
	 * accessor method for report user agent
	 *
	 * @return int value of report user agent
	 **/
	public function getReportUserAgent() : int {
		return($this->reportUserAgent);
	}








	public function jsonSerialize() {
		// TODO: Implement jsonSerialize() method.
	}
}
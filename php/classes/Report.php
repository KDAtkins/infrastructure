<?php
/**
 * Class 'Report' for Entity 'report' in Infrastructure
 *
 * @author Kevin Atkins
 **/
namespace Edu\Cnm\Infrastructure;

require_once ("autoload.php");
require_once (dirname(__DIR__, 2) . "/vendor/autoload.php");

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
	 * @var Uuid $reportId
	 **/
	private $reportId;
	/**
	 * id  for this report category; foreign key
	 * @var Uuid $reportCategoryId
	 **/
	private $reportCategoryId;
	/**
	 * content of this report
	 * @var string $reportContent
	 **/
	private $reportContent;
	/**
	 * date and time for this report
	 * @var \DateTime $reportDateTime
	 **/
	private $reportDateTime;
	/**
	 * ip address to report
	 * @var string $reportIpAddress
	 **/
	private $reportIpAddress;
	/**
	 * latitide for report
	 * @var float $reportLat;
	 **/

	private $reportLat;
	/**
	 * longitude for report
	 * @var float $reportLong
	 **/
	private $reportLong;
	/**
	 * status for report
	 * @var string $reportStatus
	 **/
	private $reportStatus;
	/**
	 * urgency for this report
	 * @var int $reportUrgency
	 **/
	private $reportUrgency;
	/**
	 * user agent for report
	 * @var string $reportUserAgent
	 **/
	private $reportUserAgent;

	public function __construct($newReportId, $newReportCategoryId, string $newReportContent, $newReportDateTime, string $newReportIpAddress, float $newReportLat, float $newReportLong, string $newReportStatus, int $newReportUrgency, string $newReportUserAgent) {
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
			$this->setReportUserAgent($newReportUserAgent);

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
	 * @param Uuid|string $newReportId new value of report id
	 * @throws \RangeException if $newReportId is not positive
	 * @throws \TypeError if $newReportId is not a uuid or string
	 **/
	public function setReportId($newReportId) : void {
		try {
			$uuid = self::validateUuid($newReportId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		$this->reportId = $uuid;
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
	 * @param Uuid|string $newReportCategoryId new value of report category id
	 * @throws \RangeException if $newReportId is not positive
	 * @throws \TypeError if $newReportCategoryId is not an integer
	 **/
	public function setReportCategoryId($newReportCategoryId) : void {
		try {
			$uuid = self::validateUuid($newReportCategoryId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		$this->reportCategoryId = $uuid;
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
	 * mutator method for report content
	 *
	 * @param string $newReportContent new value of report content
	 * @throws \InvalidArgumentException if $newReportContent is not a string or insecure
	 * @throws \RangeException if $newReportContent is > 3000
	 * @throws  \TypeError if $newReportContent is not a string
	 **/
	public function setReportContent(string $newReportContent) : void {
		//verify the report content is secure
		$newReportContent = trim($newReportContent);
		$newReportContent = filter_var($newReportContent, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

		if(empty($newReportContent) === true) {
			throw(new \InvalidArgumentException("report content is empty or insecure"));
		}

		//verify the report content will fit in the database
		if(strlen($newReportContent) > 3000) {
			throw(new \RangeException("report content too large"));
		}
		$this->reportContent = $newReportContent;
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
	 * mutator method for report date/time
	 *
	 * @param \DateTime|string|null $newReportDateTime report date/time as a DateTime object
	 * or string (or null to load the current date/time)
	 * @throws \InvalidArgumentException if $newReportDateTime is not a valid object or string
	 * @throws \RangeException if $newReportDateTime is a date/time that does exist
	 **/
	public function setReportDateTime($newReportDateTime = null) : void {
		// base case: if the date/time is null, use the current date/time
		if($newReportDateTime === null) {
			$this->reportDateTime = new \DateTime();
			return;
		}

		// store the like date/time using the Validate trait
		try {
			$newReportDateTime = self::validateDateTime($newReportDateTime);
		} catch(\InvalidArgumentException | \RangeException $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		$this->reportDateTime = $newReportDateTime;
	}

	/**
	 * accessor method for report ip address
	 *
	 * @return int value of report ip address
	 **/
	public function getReportIpAddress() : string {
		return($this->reportIpAddress);
	}

	/**
	 *  mutator method for report ip address
	 *
	 * @param $newReportIpAddress
	 **/
	public function setReportIpAddress($newReportIpAddress) : void {
		// detect the IP's format and assign it in binary mode
		if(@inet_pton($newReportIpAddress) !== false) {
			$this->reportIpAddress = inet_pton($newReportIpAddress);
		} else if(@inet_ntop($newReportIpAddress) !== false) {
			$this->reportIpAddress = $newReportIpAddress;
		} else {
			throw(new \InvalidArgumentException("invalid IP address"));
		}
	}

	/**
	 * accessor method for report latitude
	 *
	 * @return float value of report latitude
	 **/
	public function getReportLat() : float {
		return($this->reportLat);
	}

	/**
	 * mutator method for report latitude
	 *
	 * @param float $newReportLat
	 **/
	public function setReportLat(float $newReportLat): void {
		// verify the float is secure
		if(($newReportLat < -90) || ($newReportLat > 90)) {
			throw(new \RangeException("latitude is out of bounds"));
		}

		// store the latitude
		$this->reportLat = $newReportLat;
	}

	/**
	 * accessor method for report longitude
	 *
	 * @return float value of report longitude
	 **/
	public function getReportLong() : float {
		// -180 - 180
		return($this->reportLong);
	}

	/**
	 * mutator method  for report longitude
	 *
	 * @param float $newReportLong
	 **/
	public function setReportLong(float $newReportLong): void {
		// verify the float is secure
		if(($newReportLong < -180) || ($newReportLong > 180)) {
			throw(new \RangeException("latitude is out of bounds"));
		}
		// store the latitude
		$this->reportLong = $newReportLong;
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
	 * mutator method for report status
	 *
	 * @param string $newReportStatus new value of report status
	 * @throws \InvalidArgumentException if $newReportStatus is not a string or insecure
	 * @throws \RangeException if $newReportStatus is > 15 characters
	 * @throws \TypeError if $newReportStatus is not a string
	 **/
	public function setReportStatus(string $newReportStatus) : void {
		// verify the report status is secure
		$newReportStatus = trim($newReportStatus);
		$newReportStatus = filter_var($newReportStatus, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newReportStatus) === true) {
			throw(new \InvalidArgumentException("report status is empty or insecure"));
		}

		// verify the report status will fit in the database
		if(strlen($newReportStatus) > 15) {
			throw(new \RangeException("report status too long"));
		}

		//store the report status
		$this->reportStatus = $newReportStatus;
	}

	/**
	 * accessor method for report urgency
	 *
	 * @return int value of report urgency
	 **/
	public function getReportUrgency() : int {
		return($this->reportUrgency);
	}

	/**
	 * mutator method for report urgency
	 *
	 * @param int $newReportUrgency new value of report urgency
	 * @throws \InvalidArgumentException if $newReportUrgency is not an int or secure
	 * @throws \TypeError if $newReportUrgency is not an int
	 **/
	public function setReportUrgency(int $newReportUrgency) : void {
		// verify the report urgency is secure
		if($newReportUrgency > 5 || $newReportUrgency <= 0) {
			throw(new \RangeException("report urgency is out of range"));
		}

		//store the report urgency
		$this->reportUrgency = $newReportUrgency;
	}

	/**
	 * accessor method for report user agent
	 *
	 * @return int value of report user agent
	 **/
	public function getReportUserAgent() : int {
		return($this->reportUserAgent);
	}

	/**
	 * mutator method for report user agent
	 *
	 * @param string $newReportUserAgent new value of report content
	 * @throws \InvalidArgumentException if $newReportUserAgent is not a string or insecure
	 * @throws \RangeException if $newReportUserAgent is > 255
	 * @throws  \TypeError if $newReportUserAgent is not a string
	 **/
	public function setReportUserAgent(string $newReportUserAgent) : void {
		//verify the report user agent is secure
		$newReportUserAgent = trim($newReportUserAgent);
		$newReportUserAgent = filter_var($newReportUserAgent, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

		if(empty($newReportUserAgent) === true) {
			throw(new \InvalidArgumentException("report user agent is empty or insecure"));
		}

		//verify the report content will fit in the database
		if(strlen($newReportUserAgent) > 255) {
			throw(new \RangeException("report user agent too large"));
		}
		$this->reportUserAgent = $newReportUserAgent;
	}

	/**
	 * inserts this Report into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occurs
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo) : void {
		// create query template
		$query = "INSERT INTO report(reportId, reportCategoryId, reportContent, reportDateTime, reportIpAddress, 
		reportLat, reportLong, reportStatus, reportUrgency, reportUserAgent) VALUES (:reportId, :reportCategoryId, 
		:reportContent, :reportDateTime, :reportIpAddress, :reportLat, :reportLong, :reportStatus, :reportUrgency,
		:reportUserAgent)";

		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$formattedDateTime = $this->reportDateTime->format("Y-m-d H:i:s.u");
		$parameters = ["reportId" => $this->reportId->getBytes(), "reportCategoryId" => $this->reportCategoryId->getBytes(),
		"reportContent" => $this->reportContent, "reportDateTime" => $formattedDateTime, "reportIpAddress" => $this->reportIpAddress,
		"reportLat" => $this->reportLat, "reportLong" => $this->reportLong, "reportStatus" => $this->reportStatus,
		"reportUrgency" => $this->reportUrgency, "reportUserAgent" => $this->reportUserAgent];
		$statement->execute($parameters);
	}

	/**
	 * deletes this Report from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors
	 * @throws \TypeError if $pdo is not a PDO connection object
	 */
	public function delete(\PDO $pdo) : void {
		// create query template
		$query = "DELETE FROM report WHERE reportId = :reportId";

		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$parameters = ["reportId" => $this->reportId->getBytes()];
		$statement->execute($parameters);
	}

	/**
	 * updates this Report in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 */
	public function update(\PDO $pdo) : void {
		// create query template
		$query = "UPDATE report SET reportCategoryId = :reportCategoryId, reportContent = :reportContent, 
		reportDateTime = :reportDateTime, reportStatus = :reportStatus, reportUrgency = :reportUrgency 
		WHERE reportId = :reportId";

		$statement = $pdo->prepare($query);

		$formattedDateTime = $this->reportDateTime->format("Y-m-d H:i:s.u");
		$parameters = ["reportId" => $this->reportId->getBytes(), "reportCategoryId" => $this->reportCategoryId->getBytes(),
		"reportContent" => $this->reportContent, "reportDateTime" => $formattedDateTime, "reportStatus" => $this->reportStatus,
		"reportUrgency" => $this->reportUrgency];
		$statement->execute($parameters);
	}

	/**
	 * gets the Report by report id
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $reportId report id to search for
	 * @return Report|null Report not found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when a variable are not the correct data type
	 **/
	public static function getReportByReportId(\PDO $pdo, $reportId) :?Report {
		//sanitize the reportId before searching
		try {
			$reportId = self::validateUuid($reportId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}

		// create equal template
		$query = "SELECT reportId, reportCategoryId, reportContent, reportDateTime, reportIpAddress, reportLat, reportLong,
		reportStatus, reportUrgency, reportUserAgent FROM report WHERE reportId = :reportId";

		$statement = $pdo->prepare($query);

		// bind the report id to the place holder in the template
		$parameters = ["reportId" => $reportId->getBytes()];

		$statement->execute($parameters);

		// grab the report from mySQL
		try {
			$report = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$report = new Report($row["reportId"], $row["reportCategoryId"], $row["reportContent"], $row["reportDateTime"], $row["reportIpAddress"], $row["reportLat"], $row["reportLong"], $row["reportStatus"], $row["reportUrgency"], $row["reportUserAgent"]);
			}
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($report);
	}

	/**
	 * get the Report by category id
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $reportCategoryId category if to search for
	 * @return \SPLFixedArray SplFixedArray of Reports found
	 * @throws \PDOException when mySQL related  errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getReportByReportCategoryId (\PDO $pdo, string $reportCategoryId) : \SPLFixedArray {

		try {
			$reportCategoryId = self::validateUuid($reportCategoryId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}

		// create query template
		$query = "SELECT reportId, reportCategoryId, reportContent, reportDateTime, reportIpAddress, reportLat, reportLong,
		reportStatus, reportUrgency, reportUserAgent FROM report WHERE reportCategoryId = :reportCategoryId";
		$statement = $pdo->prepare($query);
		// bind the report profile id to the place holder in the template
		$parameters = ["reportCategoryId" => $reportCategoryId->getBytes()];
		$statement->execute($parameters);
		// build an array of reports
		$reports = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$report = new Report($row["reportId"], $row["reportCategoryId"], $row["reportContent"], $row["reportDateTime"], $row["reportIpAddress"], $row["reportLat"], $row["reportLong"], $row["reportStatus"], $row["reportUrgency"], $row["reportUserAgent"]);
				$reports[$reports->key()] = $report;
				$reports->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($reports);
	}

	/**
	 * get the Report by report content
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $reportContent report content to search for
	 * @return \SplFixedArray SplFixedArray of Reports found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
//	public static function getReportByReportContent(\PDO $pdo, string $reportContent) : \SplFixedArray {
//		// sanitize the description before searching
//		$reportContent = trim($reportContent);
//		$reportContent = filter_var($reportContent, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
//		if(empty($reportContent) === true) {
//			throw(new \PDOException("tweet content is invalid"));
//		}
//
//		// escape any mySQL wild cards
//		$reportContent = str_replace("_", "\\_", str_replace("%", "\\%", $reportContent));
//
//		// create query template
//		$query = "SELECT reportId, reportCategoryId, reportContent, reportDateTime, reportIpAddress, reportLat, reportLong, reportStatus, reportUrgency, reportUserAgent FROM report WHERE reportContent LIKE :reportContent";
//		$statement = $pdo->prepare($query);
//
//		// bind the report content to the place holder in the template
//		$reportContent = "%$reportContent%";
//		$parameters = ["reportContent" => $reportContent];
//		$statement->execute($parameters);
//
//		// build an array of reports
//		$reports = new \SplFixedArray($statement->rowCount());
//		$statement->setFetchMode(\PDO::FETCH_ASSOC);
//		while(($row = $statement->fetch()) !== false) {
//			try {
//				$report = new Report($row["reportId"], $row["reportCategoryId"], $row["reportContent"], $row["reportDateTime"], $row["reportIpAddress"], $row["reportLat"], $row["reportLong"], $row["reportStatus"], $row["reportUrgency"],$row["reportUserAgent"]);
//				$reports[$reports->key()] = $report;
//				$reports->next();
//			} catch(\Exception $exception) {
//				// if the row couldn't be converted, rethrow it
//				throw(new \PDOException($exception->getMessage(), 0, $exception));
//			}
//		}
//		return($reports);
//	}

	/**
	 * get the Report by report status
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $reportStatus report status to search for
	 * @return \SplFixedArray SplFixedArray of Reports found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getReportByReportStatus(\PDO $pdo, string $reportStatus) : \SplFixedArray {
		// sanitize the description before searching
		$reportStatus = trim($reportStatus);
		$reportStatus = filter_var($reportStatus, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($reportStatus) === true) {
			throw(new \PDOException("report content is invalid"));
		}

		// escape any mySQL wild cards
		$reportStatus = str_replace("_", "\\_", str_replace("%", "\\%", $reportStatus));

		// create query template
		$query = "SELECT reportId, reportCategoryId, reportContent, reportDateTime, reportIpAddress, reportLat, reportLong, reportStatus, reportUrgency, reportUserAgent FROM report WHERE reportStatus LIKE :reportStatus";
		$statement = $pdo->prepare($query);

		// bind the report content to the place holder in the template
		$reportStatus = "%$reportStatus%";
		$parameters = ["reportStatus" => $reportStatus];
		$statement->execute($parameters);

		// build an array of reports
		$reports = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$report = new Report($row["reportId"], $row["reportCategoryId"], $row["reportContent"], $row["reportDateTime"], $row["reportIpAddress"], $row["reportLat"], $row["reportLong"], $row["reportStatus"], $row["reportUrgency"],$row["reportUserAgent"]);
				$reports[$reports->key()] = $report;
				$reports->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($reports);
	}

	/**
	 * get the Report by report urgency
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $reportUrgency report status to search for
	 * @return \SplFixedArray SplFixedArray of Reports found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getReportByReportUrgency(\PDO $pdo, int $reportUrgency) : \SplFixedArray {
		// create query template
		$query = "SELECT reportId, reportCategoryId, reportContent, reportDateTime, reportIpAddress, reportLat, reportLong, reportStatus, reportUrgency, reportUserAgent FROM report WHERE reportUrgency LIKE :reportUrgency";
		$statement = $pdo->prepare($query);

		// bind the report content to the place holder in the template
		$reportUrgency = "%$reportUrgency%";
		$parameters = ["reportUrgency" => $reportUrgency];
		$statement->execute($parameters);

		// build an array of reports
		$reports = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$report = new Report($row["reportId"], $row["reportCategoryId"], $row["reportContent"], $row["reportDateTime"], $row["reportIpAddress"], $row["reportLat"], $row["reportLong"], $row["reportStatus"], $row["reportUrgency"],$row["reportUserAgent"]);
				$reports[$reports->key()] = $report;
				$reports->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($reports);
	}

	/**
	 * gets an array of reports based on its date
	 * (this is an optional get by method and has only been added for when specific edge cases arise in capstone projects)
	 *
	 * @param \PDO $pdo connection object
	 * @param \DateTime $sunriseReportDateTime beginning date to search for
	 * @param \DateTime $sunsetReportDateTime ending date to search for
	 * @return \SplFixedArray of reports found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 * @throws \InvalidArgumentException if either sun dates are in the wrong format
	 */
	public static function getReportByReportDateTime (\PDO $pdo, \DateTime $sunriseReportDateTime, \DateTime $sunsetReportDateTime ) : \SplFixedArray {
		//enforce both date are present
		if((empty ($sunriseReportDateTime) === true) || (empty($sunsetReportDateTime) === true)) {
			throw (new \InvalidArgumentException("dates are empty of insecure"));
		}
		//ensure both dates are in the correct format and are secure
		try {
			$sunriseReportDateTime = self::validateDateTime($sunriseReportDateTime);
			$sunsetReportDateTime = self::validateDateTime($sunsetReportDateTime);
		} catch(\InvalidArgumentException | \RangeException $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		//create query template
		$query = "SELECT reportId, reportCategoryId, reportContent, reportDateTime, reportIpAddress, reportLat, reportLong, reportStatus, reportUrgency, reportUserAgent from report WHERE reportDateTime >= :sunriseReportDateTime AND reportDateTime <= :sunsetReportDateTime";
		$statement = $pdo->prepare($query);
		//format the dates so that mySQL can use them
		$formattedSunriseDate = $sunriseReportDateTime->format("Y-m-d H:i:s.u");
		$formattedSunsetDate = $sunsetReportDateTime->format("Y-m-d H:i:s.u");
		$parameters = ["sunriseReportDateTime" => $formattedSunriseDate, "sunsetReportDateTime" => $formattedSunsetDate];
		$statement->execute($parameters);
		//build an array of tweets
		$reports = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch())  !== false) {
			try {
				$report = new Report($row["reportId"], $row["reportCategoryId"], $row["reportContent"], $row["reportDateTime"],$row["reportIpAddress"], $row["reportLat"], $row["reportLong"], $row["reportStatus"], $row["reportUrgency"], $row["reportUserAgent"]);
				$reports[$reports->key()] = $report;
				$reports->next();
			} catch(\Exception $exception) {
				throw (new \PDOException($exception->getMessage(),0, $exception));
			}
		}
		return($reports);
	}

	/**
	 * gets all Reports
	 *
	 * @param \PDO $pdo PDO connection object
	 * @return \SplFixedArray SplFixedArray of Reports found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getAllReports(\PDO $pdo) : \SPLFixedArray {
		// create query template
		$query = "SELECT reportId, reportCategoryId, reportContent, reportDateTime,reportIpAddress, reportLat, reportLong, reportStatus, reportUrgency, reportUserAgent FROM report";
		$statement = $pdo->prepare($query);
		$statement->execute();

		// build an array of reports

		$reports = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$report = new Report($row["reportId"], $row["reportCategoryId"], $row["reportContent"], $row["reportDateTime"], $row["reportIpAddress"], $row["reportLat"], $row["reportLong"], $row["reportStatus"], $row["reportUrgency"], $row["reportUserAgent"]);
				$reports[$reports->key()] = $report;
				$reports->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($reports);
	}

	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 */
	public function jsonSerialize() {
		$fields = get_object_vars($this);

		$fields["reportId"] = $this->reportId;
		$fields["reportCategoryId"] = $this->reportCategoryId;

		// format the date so that the front end can consume it
		$fields["reportDateTime"] = round(floatval($this->reportDateTime->format("U.u")) * 1000);
		return ($fields);
	}
}
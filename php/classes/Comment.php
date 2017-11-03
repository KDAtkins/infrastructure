<?php
/**
 * This is the Comment entity. The Comment entity handles comments on reports.
 *
 * @author Jack Arnold
 * @version 7.1
 **/

namespace Edu\Cnm\Infrastructure;

require_once("autoload.php");
require_once(dirname(__DIR__, 2) . "/vendor/autoload.php");

use Ramsey\Uuid\Uuid;

class Comment implements \JsonSerializable {
    use ValidateDate;
    use ValidateUuid;

    /**
     * Primary key, Id for comments posted on reports
     * @var Uuid $commentId
     **/
    private $commentId;

    /**
     * Foreign key, Id for the profile that posted the comment in question
     * @var Uuid $commentProfileId
     **/
    private $commentProfileId;

    /**
     * Foreign key, Id for the report that the comment in question was posted on
     * @var Uuid $commentReportId
     **/
    private $commentReportId;

    /**
     * The content of the comment posted by the user profile
     * @var string $commentContent
     **/
    private $commentContent;

    /**
     * This is the date and time the comment was posted
     * @var \DateTime $commentDateTime
     **/
    private $commentDateTime;

    /**
     * Constructor for the comment
     *
     * @param Uuid $commentId id of the comment
     * @param Uuid $commentProfileId id of the profile that posted the comment
     * @param Uuid $commentReportId id of the report the comment was posted on
     * @param string $commentContent the text written in the comment
     * @param \DateTime|string|null $commentDateTime the
     * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
     * @throws \TypeError if data types violate type hints
     * @throws \Exception if some other exception occurs
     **/
    public function __construct($newCommentId, $newCommentProfileId, $newCommentReportId, string $newCommentContent, $newCommentDate = null) {
       try {
      	 	$this->setCommentId($newCommentId);
				$this->setCommentProfileId($newCommentProfileId);
				$this->setCommentReportId($newCommentReportId);
				$this->setCommentContent($newCommentContent);
				$this->setCommentDate($newCommentDate);
       } catch (\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
           $exceptionType = get_class($exception);
           throw(new $exceptionType($exception->getMessage(), 0, $exception));
       }
    }

    /**
     * accessor method for commentId
     *
     * @return Uuid of commentId
     **/
    public function getCommentId() : Uuid {
        return $this->commentId;
    }

    /**
     * @param string $newCommentId new value of commentId
     * @throws \InvalidArgumentException if data types are invalid
     * @throws \RangeException if string values are too long
     * @throws \TypeError if data types are invalid
     * @throws \Exception for any other exception
     **/
    public function setCommentId() : Uuid {
        try {
            $uuid = self::validateUuid($newCommentId);
        } catch (\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
            $exceptionType = get_class($exception);
            throw(new $exceptionType($exception->getMessage(), 0, $exception));
        }
        $this->commentId = $uuid;
    }

    /**
     * accessor method for commentProfileId
     *
     * @return Uuid of commentProfileId
     **/
    public function getcommentProfileId() : Uuid {
        return $this->commentProfileId;
    }

    /**
     * @param string $newcommentProfileId new value of commentProfileId
     * @throws \InvalidArgumentException if data types are invalid
     * @throws \RangeException if string values are too long
     * @throws \TypeError if data types are invalid
     * @throws \Exception for any other exception
     **/
    public function setcommentProfileId() : Uuid {
        try {
            $uuid = self::validateUuid($newcommentProfileId);
        } catch (\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
            $exceptionType = get_class($exception);
            throw(new $exceptionType($exception->getMessage(), 0, $exception));
        }
        $this->commentProfileId = $uuid;
    }

    /**
     * accessor method for commentReportId
     *
     * @return Uuid of commentReportId
     **/
    public function getcommentReportId() : Uuid {
        return $this->commentReportId;
    }

    /**
     * @param string $newcommentReportId new value of commentReportId
     * @throws \InvalidArgumentException if data types are invalid
     * @throws \RangeException if string values are too long
     * @throws \TypeError if data types are invalid
     * @throws \Exception for any other exception
     **/
    public function setcommentReportId() : Uuid {
        try {
            $uuid = self::validateUuid($newcommentReportId);
        } catch (\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
            $exceptionType = get_class($exception);
            throw(new $exceptionType($exception->getMessage(), 0, $exception));
        }
        $this->commentReportId = $uuid;
    }

    /**
     * accessor method for commentContent
     *
     * @return string returns the comment content
     **/
    public function getCommentContent() : void {
        return $this->commentContent;
    }

    /**
     * @param string $newCommentContent new value of commentContent
     * @throws \InvalidArgumentException if data types are invalid
     * @throws \RangeException if string values are too long
     * @throws \TypeError if $newCommentContent is not a string
     * @throws \Exception for any other exception
     **/
    public function setCommentContent() : void {
        $newCommentContent = trim($newCommentContent);
        $newCommentContent = filter_var($newCommentContent, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
        if (empty($newCommentContent) === true) {
            throw(new \InvalidArgumentException("commentContent is empty or insecure"));
        }
        if (strlen($newCommentContent) > 3000) {
            throw(new \RangeException("commentContent is too large"));
        }
        $this->commentsContent = $newCommentsContent;
    }

    /**
     * Inserts this Comment into MySQL
     *
     * @param \PDO $pdo PDO connection object
     * @throws \PDOException when mySQL related errors occur
     * @throws \TypeError if $pdo is not a PDO connection object
     **/
    public function insert(\PDO $pdo) {
        if ($this->commentId !== false) {
            throw(new \PDOException("Not a new comment"));
        }
        $query = "INSERT INTO comment(commentId, commentProfileId, commentReportId, commentContent, commentDateTime) VALUES(:commentId, :commentProfileId, :commentReportId, :commentContent, :commentDateTime)";
        $statement = $pdo->prepare($query);
        $parameters = ["commentId" => $this->commentId->getBytes(), "commentProfileId" => $this->commentProfileId->getBytes(), "commentProfileId" => $this->commentReportId->getBytes(), "commentContent" => $this->commentContent, "commentDateTime" => $this->commentDateTime];
        $statement->execute($parameters);
    }

    /**
     * Updates this Comment in MySQL
     *
     * @param \PDO $pdo PDO connection object
     * @throws \PDOException when mySQL related errors occur
     * @throws \TypeError if $pdo is not a PDO connection object
     **/
    public function update(\PDO $pdo) {
        if($this->commentId === null) {
            throw(new("Unable to update nonexistent comment"));
        }
        $query = "UPDATE `comment` SET commentId = :commentId, commentProfileId = :commentProfileId, commentReportId = :commentReportId, commentContent = :commentContnt, commentDateTime = :commentDateTime";
        $statement = $pdo->prepare($query);
        $parameters = ["commentId" => $this->commentId->getBytes(), "commentProfileId" => $this->commentProfileId->getBytes(), "commentProfileId" => $this->commentReportId->getBytes(), "commentContent" => $this->commentContent, "commentDateTime" => $this->commentDateTime];
        $statement->execute($parameters);
    }

    /**
     * Deletes this Comment from MySQL
     *
     * @param \PDO $pdo PDO connection object
     * @throws \PDOException when mySQL related errors occur
     * @throws \TypeError if $pdo is not a PDO connection object
     **/
    public function delete(\PDO $pdo): void {
        //enforce the commentId is not null (don't delete a comment that does not exist)
        if($this->commentId === null) {
            throw(new \PDOException("unable to delete a comment that does not exist"));
        }
        //create query template
        $query = "DELETE FROM comment WHERE commentId = :commentId";
        $statement = $pdo->prepare($query);
        //bind the member variables to the place holders in the template
        $parameters = ["commentId" => $this->commentId];
        $statement->execute($parameters);
    }
    /**
     * gets the Comment by the comment's id
     *
     * @param \PDO $pdo PDO connection object
     * @param Uuid $commentId comment id to search for
     * @return Comment|null Comment or null if not found
     * @throws \PDOException when mySQL related errors occur
     * @throws \TypeError when variables are not the correct data type
     **/
    public static function getCommentByCommentId(\PDO $pdo, $commentId) : ?Comment {
        try {
            $commentId = self::validateUuid($commentId);
        } catch (\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
            throw (new \PDOException($exception->getMessage(), 0, $exception));
        }
        $query = "SELECT commentId FROM comment WHERE commentId = :commentId";
        $statement = $pdo->prepare($query);
        $parameters = ["commentId" = $commentId];
        $statement->execute($parameters);
        try {
            $comment = null;
            $statement->setFetchMode(\PDO::FETCH_ASSOC);
            $row = $statement->fetch();
            if($row !== false) {
                $comment = new Comment($row["commentId"], $row["commentProfileId"], $row["commentReportId"]);
        } catch(\Exception $exception) {
                throw(new\PDOException($exception->getMessage(), 0, $exception));
            }
		return ($category);
    }

    public function jsonSerialize() {
        $fields = get_object_vars($this);
        $fields["commentId"] = $this->commentId->toString();
        $fields["commentProfileId"] = $this->commentProfileId->toString();
        $fields["commentReportId"] = $this->commentReportId->toString();
        $fields["commentContent"] = $this->commentContent->toString();
        $fields["commentDateTime"] = $this->commentDateTime->toString();
    }
}
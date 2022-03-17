<?php
// Include config file
require_once $_SERVER['DOCUMENT_ROOT'] . "/visionFlowConfig.php";

function login() {
    //Log in:
    try {
        $client = new SoapClient('http://www.visionflow.com/api/docs/service.wsdl', array('trace' => true, 'exceptions' => false));
    } catch (SoapFault $e) {
        var_dump($e->getMessage());
        exit;
    }
    $client->__setLocation('https://www.visionflow.com/service/VisionProject-v2/VisionProjectWebServiceService');

    $systemUser = $client->loginWithAPIKey2(array(
        'username' => $username,
        'password' => $password,
        'webserviceAPIKey' => $webserviceAPIKey
    ));

    return $client;
}

function findProjectIssues() {

    $client = login();
    return $client->findProjectIssues(array('queryObject' => array(
        'actualTime' => 0,
        'attachmentCount' => 0,
        'billingAmount' => 0,
        'buildNumber' => 0,
        'componentId' => 0,
        'contractId' => 0,
        'containsRecipients' => 0,
        'containsRecipientsHasBeenSet' => 0,
        'costAmount' => 0,
        'createdBySystemUserId' => 0,
        'currentOwnerSystemUserId' => 0,
        'currentOwnerUserGroupId' => 0,
        'customerId' => 0,
        'fixedPrice' => 0,
        'fixedTime' => 0,
        'isVoteable' => 0,
        'isVoteableHasBeenSet' => 0,
        'issueNotIncludedInRecurringSeries' => 0,
        'issueNotIncludedInRecurringSeriesHasBeenSet' => 0,
        'issuePriorityId' => 0,
        'issueCreatedBySystemUserId' => 0,
        'issueEscalationLevelId' => 0,
        'issueUrgencyId' => 0,
        'issueRank' => 0,
        'issueResolutionId' => 0,
        'issueSeverityId' => 0,
        'issueStatusId' => 0,
        'issueTemplateTypeId' => 0,
        'issueTypeId' => 0,
        'lastRepliedById' => 0,
        'latestReplyIsBySupportUser' => 0,
        'latestReplyIsBySupportUserHasBeenSet' => 0,
        'locationId' => 0,
        'mailSettingId' => 0,
        'numberOfComments' => 0,
        'numberOfSubIssues' => 0,
        'originalEmailFormat' => 0,
        'originalEstimatedTime' => 0,
        'parentProjectIssueId' => 0,
        'permissionType' => 0,
        'primaryKey' => 0,
        'productConfigItemId' => 0,
        'projectId' => 29909,
        'rating' => 0,
        'recurringIssueTemplateProjectIssueId' => 0,
        'releaseId' => 0,
        'releaseVersionId' => 0,
        'remainingTime' => 0,
        'responsibleSystemUserId' => 0,
        'SLAPlanId' => 0,
        'SLAPlanManually' => 0,
        'storyPoints' => 0,
        'subIssueOrder' => 0,
        'subIssuesDoneInOrder' => 0,
        'subIssuesDoneInOrderHasBeenSet' => 0,
        'ticketId' => 0,
        'votes' => 0,
    )));
}

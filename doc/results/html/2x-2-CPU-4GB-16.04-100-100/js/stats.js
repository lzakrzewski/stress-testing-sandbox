var stats = {
    type: "GROUP",
name: "Global Information",
path: "",
pathFormatted: "group_missing-name-b06d1",
stats: {
    "name": "Global Information",
    "numberOfRequests": {
        "total": "10100",
        "ok": "7911",
        "ko": "2189"
    },
    "minResponseTime": {
        "total": "0",
        "ok": "9",
        "ko": "0"
    },
    "maxResponseTime": {
        "total": "23051",
        "ok": "23051",
        "ko": "664"
    },
    "meanResponseTime": {
        "total": "7371",
        "ok": "9410",
        "ko": "2"
    },
    "standardDeviation": {
        "total": "7996",
        "ok": "7902",
        "ko": "14"
    },
    "percentiles1": {
        "total": "3780",
        "ok": "8556",
        "ko": "1"
    },
    "percentiles2": {
        "total": "15323",
        "ok": "17941",
        "ko": "2"
    },
    "percentiles3": {
        "total": "20428",
        "ok": "20515",
        "ko": "3"
    },
    "percentiles4": {
        "total": "20843",
        "ok": "20884",
        "ko": "6"
    },
    "group1": {
        "name": "t < 220 ms",
        "count": 1661,
        "percentage": 16
    },
    "group2": {
        "name": "220 ms < t < 320 ms",
        "count": 91,
        "percentage": 1
    },
    "group3": {
        "name": "t > 320 ms",
        "count": 6159,
        "percentage": 61
    },
    "group4": {
        "name": "failed",
        "count": 2189,
        "percentage": 22
    },
    "meanNumberOfRequestsPerSecond": {
        "total": "75.373",
        "ok": "59.037",
        "ko": "16.336"
    }
},
contents: {
"req_wall-94e8a": {
        type: "REQUEST",
        name: "Wall",
path: "Wall",
pathFormatted: "req_wall-94e8a",
stats: {
    "name": "Wall",
    "numberOfRequests": {
        "total": "5050",
        "ok": "4014",
        "ko": "1036"
    },
    "minResponseTime": {
        "total": "0",
        "ok": "9",
        "ko": "0"
    },
    "maxResponseTime": {
        "total": "21024",
        "ok": "21024",
        "ko": "664"
    },
    "meanResponseTime": {
        "total": "6774",
        "ok": "8522",
        "ko": "2"
    },
    "standardDeviation": {
        "total": "7543",
        "ok": "7529",
        "ko": "21"
    },
    "percentiles1": {
        "total": "3439",
        "ok": "7209",
        "ko": "1"
    },
    "percentiles2": {
        "total": "13053",
        "ok": "15902",
        "ko": "2"
    },
    "percentiles3": {
        "total": "20109",
        "ok": "20180",
        "ko": "3"
    },
    "percentiles4": {
        "total": "20481",
        "ok": "20525",
        "ko": "7"
    },
    "group1": {
        "name": "t < 220 ms",
        "count": 886,
        "percentage": 18
    },
    "group2": {
        "name": "220 ms < t < 320 ms",
        "count": 40,
        "percentage": 1
    },
    "group3": {
        "name": "t > 320 ms",
        "count": 3088,
        "percentage": 61
    },
    "group4": {
        "name": "failed",
        "count": 1036,
        "percentage": 21
    },
    "meanNumberOfRequestsPerSecond": {
        "total": "37.687",
        "ok": "29.955",
        "ko": "7.731"
    }
}
    },"req_publishpost-28274": {
        type: "REQUEST",
        name: "PublishPost",
path: "PublishPost",
pathFormatted: "req_publishpost-28274",
stats: {
    "name": "PublishPost",
    "numberOfRequests": {
        "total": "5050",
        "ok": "3897",
        "ko": "1153"
    },
    "minResponseTime": {
        "total": "0",
        "ok": "26",
        "ko": "0"
    },
    "maxResponseTime": {
        "total": "23051",
        "ok": "23051",
        "ko": "46"
    },
    "meanResponseTime": {
        "total": "7967",
        "ok": "10324",
        "ko": "1"
    },
    "standardDeviation": {
        "total": "8382",
        "ok": "8168",
        "ko": "2"
    },
    "percentiles1": {
        "total": "4313",
        "ok": "10499",
        "ko": "1"
    },
    "percentiles2": {
        "total": "17365",
        "ok": "19363",
        "ko": "1"
    },
    "percentiles3": {
        "total": "20618",
        "ok": "20694",
        "ko": "2"
    },
    "percentiles4": {
        "total": "20977",
        "ok": "21015",
        "ko": "6"
    },
    "group1": {
        "name": "t < 220 ms",
        "count": 775,
        "percentage": 15
    },
    "group2": {
        "name": "220 ms < t < 320 ms",
        "count": 51,
        "percentage": 1
    },
    "group3": {
        "name": "t > 320 ms",
        "count": 3071,
        "percentage": 61
    },
    "group4": {
        "name": "failed",
        "count": 1153,
        "percentage": 23
    },
    "meanNumberOfRequestsPerSecond": {
        "total": "37.687",
        "ok": "29.082",
        "ko": "8.604"
    }
}
    }
}

}

function fillStats(stat){
    $("#numberOfRequests").append(stat.numberOfRequests.total);
    $("#numberOfRequestsOK").append(stat.numberOfRequests.ok);
    $("#numberOfRequestsKO").append(stat.numberOfRequests.ko);

    $("#minResponseTime").append(stat.minResponseTime.total);
    $("#minResponseTimeOK").append(stat.minResponseTime.ok);
    $("#minResponseTimeKO").append(stat.minResponseTime.ko);

    $("#maxResponseTime").append(stat.maxResponseTime.total);
    $("#maxResponseTimeOK").append(stat.maxResponseTime.ok);
    $("#maxResponseTimeKO").append(stat.maxResponseTime.ko);

    $("#meanResponseTime").append(stat.meanResponseTime.total);
    $("#meanResponseTimeOK").append(stat.meanResponseTime.ok);
    $("#meanResponseTimeKO").append(stat.meanResponseTime.ko);

    $("#standardDeviation").append(stat.standardDeviation.total);
    $("#standardDeviationOK").append(stat.standardDeviation.ok);
    $("#standardDeviationKO").append(stat.standardDeviation.ko);

    $("#percentiles1").append(stat.percentiles1.total);
    $("#percentiles1OK").append(stat.percentiles1.ok);
    $("#percentiles1KO").append(stat.percentiles1.ko);

    $("#percentiles2").append(stat.percentiles2.total);
    $("#percentiles2OK").append(stat.percentiles2.ok);
    $("#percentiles2KO").append(stat.percentiles2.ko);

    $("#percentiles3").append(stat.percentiles3.total);
    $("#percentiles3OK").append(stat.percentiles3.ok);
    $("#percentiles3KO").append(stat.percentiles3.ko);

    $("#percentiles4").append(stat.percentiles4.total);
    $("#percentiles4OK").append(stat.percentiles4.ok);
    $("#percentiles4KO").append(stat.percentiles4.ko);

    $("#meanNumberOfRequestsPerSecond").append(stat.meanNumberOfRequestsPerSecond.total);
    $("#meanNumberOfRequestsPerSecondOK").append(stat.meanNumberOfRequestsPerSecond.ok);
    $("#meanNumberOfRequestsPerSecondKO").append(stat.meanNumberOfRequestsPerSecond.ko);
}

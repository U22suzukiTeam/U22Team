CREATE DATABASE U22;
use U22;
CREATE TABLE destination (
  destinationID INT NOT NULL AUTO_INCREMENT COMMENT '目的地ID（主キー）',
  roomID INT NOT NULL COMMENT 'ルームID（room:roomID）',
  latitude DOUBLE(8,6) NOT NULL DEFAULT '35.651947' COMMENT '緯度',
  longitude DOUBLE(9,6) NOT NULL DEFAULT '139.732835' COMMENT '経度',
  delflg BIT(1) NOT NULL DEFAULT b'0' COMMENT '削除フラグ',
  PRIMARY KEY (destinationID)
)engine=InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

CREATE TABLE point (
  pointID INT NOT NULL AUTO_INCREMENT COMMENT '位置情報ID（主キー）',
  memberID INT NOT NULL COMMENT 'メンバーID（member:memberID）',
  latitude DOUBLE(8,6) NOT NULL COMMENT '緯度',
  longitude DOUBLE(9,6) NOT NULL COMMENT '経度',
  delflg BIT(1) NOT NULL DEFAULT b'0' COMMENT '削除フラグ',
  PRIMARY KEY (pointID),
  FOREIGN KEY (memberID) REFERENCES member(memberID)
)engine=InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

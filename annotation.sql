CREATE TABLE IF NOT EXISTS `symfony`.`Annotation` (
  `idAnnotation` INT NOT NULL AUTO_INCREMENT,
  `idUser` INT NOT NULL,
  `idArticle` INT NOT NULL,
  `AnnotationType` ENUM('comment','like','signalement') NULL,
  `AnnotationContent` LONGTEXT NULL,
  PRIMARY KEY (`idAnnotation`),
  INDEX `fk_Annotation_User1_idx` (`idUser` ASC),
  INDEX `fk_Annotation_Article1_idx` (`idArticle` ASC),
  CONSTRAINT `fk_Annotation_User1`
    FOREIGN KEY (`idUser`)
    REFERENCES `symfony`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Annotation_Article1`
    FOREIGN KEY (`idArticle`)
    REFERENCES `symfony`.`Article` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;